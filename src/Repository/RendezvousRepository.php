<?php

namespace App\Repository;

use App\Entity\Rendezvous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rendezvous|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rendezvous|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rendezvous[]    findAll()
 * @method Rendezvous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezvousRepository extends ServiceEntityRepository {

	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, Rendezvous::class);
	}

	public function findComing() {
		return $this->createQueryBuilder('r')
				->andWhere('r.date >= :today')
				->setParameter('today', date_create('now'))
				->getQuery()
				->getResult();
	}

	// /**
	//  * @return Rendezvous[] Returns an array of Rendezvous objects
	//  */
	// public function findByExampleField($value) {
	// 	return $this->createQueryBuilder('r')
	// 			->andWhere('r.exampleField = :val')
	// 			->setParameter('val', $value)
	// 			->orderBy('r.id', 'ASC')
	// 			->setMaxResults(10)
	// 			->getQuery()
	// 			->getResult();
	// }


	// public function findOneBySomeField($value): ?Rendezvous {
	// 	return $this->createQueryBuilder('r')
	// 			->andWhere('r.exampleField = :val')
	// 			->setParameter('val', $value)
	// 			->getQuery()
	// 			->getOneOrNullResult();
	// }


}
