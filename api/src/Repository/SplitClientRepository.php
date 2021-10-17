<?php

namespace App\Repository;

use App\Entity\SplitClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SplitClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method SplitClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method SplitClient[]    findAll()
 * @method SplitClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SplitClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SplitClient::class);
    }

    // /**
    //  * @return SplitClient[] Returns an array of SplitClient objects
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
    public function findOneBySomeField($value): ?SplitClient
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
