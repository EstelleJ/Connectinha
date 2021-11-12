<?php

namespace App\Repository;

use App\Entity\PageProductsSlider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageProductsSlider|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageProductsSlider|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageProductsSlider[]    findAll()
 * @method PageProductsSlider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageProductsSliderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageProductsSlider::class);
    }

    // /**
    //  * @return PageProductsSlider[] Returns an array of PageProductsSlider objects
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
    public function findOneBySomeField($value): ?PageProductsSlider
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
