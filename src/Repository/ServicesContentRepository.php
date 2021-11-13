<?php

namespace App\Repository;

use App\Entity\ServicesContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServicesContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicesContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicesContent[]    findAll()
 * @method ServicesContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicesContent::class);
    }

    // /**
    //  * @return ServicesContent[] Returns an array of ServicesContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServicesContent
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
