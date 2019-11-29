<?php

namespace App\Repository;

use App\Entity\Watch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Watch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Watch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Watch[]    findAll()
 * @method Watch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatchRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Watch::class);
    }

//    /**
//     * @return Watch[] Returns an array of Watch objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Watch
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
