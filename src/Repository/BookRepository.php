<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository {
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager) {
        parent::__construct($registry, Book::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param $parameters
     * @return Book[]
     */
    public function filterBooksByParameters($parameters): array {
        dump($parameters);
        $queryBuilder = $this
            ->createQueryBuilder('book');
        foreach ($parameters as $key => $value) {
            if ($key == 'authors') {
                $queryBuilder
                    ->leftJoin('book.authors', 'authors')
                    ->andWhere('authors IN (:authors)')
                    ->setParameter(':authors', $value);
            } else {
                $conditionState = ($key == 'year')
                    ? '='
                    : 'LIKE';
                $queryBuilder
                    ->andWhere("book.$key $conditionState :$key")
                    ->setParameter($key, $conditionState == '=' ? "$value" : "$value%");
            }

        }
        $query = $queryBuilder->getQuery();
        return $query->execute();
    }

    /**
     * @return Book[]
     * @throws DBALException
     */
    public function findBooksByNativeSql() {
        $nativeSqlQuery = '
          SELECT name, count
              FROM books
                  INNER JOIN
                      (SELECT book_id, COUNT(*) as count
                          FROM book_user GROUP BY book_id
                              HAVING COUNT(*) > 1) b
                  ON books.id = b.book_id
                  ORDER BY count ASC;';
        $connection = $this->entityManager->getConnection();
        try {
            $stmt = $connection->prepare($nativeSqlQuery);
            $stmt->execute();
        } catch (DBALException $e) {
            throw new Exception('Query error!');
        }
        return $stmt->fetchAll();
    }

    public function findBooksByQueryBuilder() {
        $queryBuilder = $this->createQueryBuilder('book');
        $query = $queryBuilder
            ->innerJoin('book.authors', 'authors')
            ->having('count(authors) > 1')
            ->groupBy('book.id')
            ->orderBy('count(authors)', 'ASC')
            ->getQuery();
        return $query->getResult();
    }
}
