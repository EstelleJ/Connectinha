<?php

namespace App\Repository;

use App\Entity\ProductSubcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductSubcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductSubcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductSubcategory[]    findAll()
 * @method ProductSubcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductSubcategoryRepository extends ServiceEntityRepository {

	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, ProductSubcategory::class);
	}

	// /**
	//  * @return ProductSubcategory[] Returns an array of ProductSubcategory objects
	//  */
	// public function findByExampleField($value) {
	// 	return $this->createQueryBuilder('p')
	// 			->andWhere('p.exampleField = :val')
	// 			->setParameter('val', $value)
	// 			->orderBy('p.id', 'ASC')
	// 			->setMaxResults(10)
	// 			->getQuery()
	// 			->getResult();
	// }


	// public function findOneBySomeField($value): ?ProductSubcategory {
	// 	return $this->createQueryBuilder('p')
	// 			->andWhere('p.exampleField = :val')
	// 			->setParameter('val', $value)
	// 			->getQuery()
	// 			->getOneOrNullResult();
	// }
}
