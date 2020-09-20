<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Book::class);
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
}
