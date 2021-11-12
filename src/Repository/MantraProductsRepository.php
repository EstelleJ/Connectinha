<?php

namespace App\Repository;

use App\Entity\MantraProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MantraProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method MantraProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method MantraProducts[]    findAll()
 * @method MantraProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MantraProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MantraProducts::class);
    }

    // /**
    //  * @return MantraProducts[] Returns an array of MantraProducts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MantraProducts
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
