<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllWithPagination(int $page): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u, a, p
            FROM App\Entity\User u
            LEFT JOIN u.address a
            LEFT JOIN u.phones p'
        );

        return new Paginator($query, $page);
    }

    public function getUserWithAddressAndPhonesByUserId(int $id): ?User
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u, a, p
            FROM App\Entity\User u
            LEFT JOIN u.address a
            LEFT JOIN u.phones p
            WHERE u.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function getUserWithAllJoinedEntitiesByUserId(int $id): ?User
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u, a, p, m, s, uc
            FROM App\Entity\User u
            LEFT JOIN u.address a
            LEFT JOIN u.phones p
            LEFT JOIN u.multiStores m
            LEFT JOIN u.stores s
            LEFT JOIN u.userCredentials uc
            WHERE u.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function isUniqueEmail(string $email): bool
    {
        return null === $this->findOneBy(['email' => $email]);
    }

    public function isUniqueUsername(string $username): bool
    {
        return null === $this->findOneBy(['username' => $username]);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->save($user, true);
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
