<?php

namespace App\Repository;

use App\Entity\FreeShipping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FreeShipping|null find($id, $lockMode = null, $lockVersion = null)
 * @method FreeShipping|null findOneBy(array $criteria, array $orderBy = null)
 * @method FreeShipping[]    findAll()
 * @method FreeShipping[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FreeShippingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FreeShipping::class);
    }

    // /**
    //  * @return FreeShipping[] Returns an array of FreeShipping objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FreeShipping
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
