<?php

namespace App\Repository;

use App\Entity\Distance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Distance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Distance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Distance[]    findAll()
 * @method Distance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DistanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Distance::class);
    }

    // /**
    //  * @return DistanceRDV[] Returns an array of DistanceRDV objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DistanceRDV
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
