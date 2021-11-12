<?php

namespace App\Repository;

use App\Entity\PageProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageProducts[]    findAll()
 * @method PageProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageProducts::class);
    }

    // /**
    //  * @return PageProducts[] Returns an array of PageProducts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageProducts
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
