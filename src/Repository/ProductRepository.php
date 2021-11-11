<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository {

	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, Product::class);
	}

	/**
	 * @return Product[] Returns an array of Product objects
	 */
	public function findBySubcategory($subcategoryId, $nbElements, $offset) {
		return $this->createQueryBuilder('p')
				->innerJoin('p.subcategory', 's')
				->andWhere('s.id = :subcategory')
				->setParameter('subcategory', $subcategoryId)
				->andWhere('p.active = :active')
				->setParameter('active', 1)
				->orderBy('p.id', 'DESC')
				->setMaxResults($nbElements)
				->setFirstResult($offset)
				->getQuery()
				->getResult();
	}

	// public function findOneBySomeField($value): ?Product {
	// 	return $this->createQueryBuilder('p')
	// 			->andWhere('p.exampleField = :val')
	// 			->setParameter('val', $value)
	// 			->getQuery()
	// 			->getOneOrNullResult();
	// }
}
