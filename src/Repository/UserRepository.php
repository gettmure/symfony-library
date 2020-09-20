<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, User::class);
    }

    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }
        $user->setPassword($newEncodedPassword);
        try {
            $this->_em->persist($user);
            $this->_em->flush();
        } catch (ORMException $error) {
            dump($error);
        }
    }

    public function getAuthors() {
        $queryBuilder = $this
            ->createQueryBuilder('user');
        $query = $queryBuilder
            ->innerJoin('user.books', 'books')
            ->where($queryBuilder->expr()->isNotNull('books'));
        $query = $queryBuilder->getQuery();
        return $query->execute();
    }
}
