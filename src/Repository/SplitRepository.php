<?php

namespace App\Repository;

use App\Entity\Split;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Split|null find($id, $lockMode = null, $lockVersion = null)
 * @method Split|null findOneBy(array $criteria, array $orderBy = null)
 * @method Split[]    findAll()
 * @method Split[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SplitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Split::class);
    }

    // /**
    //  * @return Split[] Returns an array of Split objects
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
    public function findOneBySomeField($value): ?Split
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
