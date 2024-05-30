<?php

namespace App\Repository;

use App\Entity\BoiteFibre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoiteFibre>
 *
 * @method BoiteFibre|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoiteFibre|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoiteFibre[]    findAll()
 * @method BoiteFibre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoiteFibreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoiteFibre::class);
    }

//    /**
//     * @return BoiteFibre[] Returns an array of BoiteFibre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BoiteFibre
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
