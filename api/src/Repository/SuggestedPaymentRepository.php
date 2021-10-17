<?php

namespace App\Repository;

use App\Entity\SuggestedPayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuggestedPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuggestedPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuggestedPayment[]    findAll()
 * @method SuggestedPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuggestedPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuggestedPayment::class);
    }

    // /**
    //  * @return SuggestedPayment[] Returns an array of SuggestedPayment objects
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
    public function findOneBySomeField($value): ?SuggestedPayment
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
