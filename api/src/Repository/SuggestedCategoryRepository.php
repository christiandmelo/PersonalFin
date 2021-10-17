<?php

namespace App\Repository;

use App\Entity\SuggestedCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuggestedCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuggestedCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuggestedCategory[]    findAll()
 * @method SuggestedCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuggestedCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuggestedCategory::class);
    }

    // /**
    //  * @return SuggestedCategory[] Returns an array of SuggestedCategory objects
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
    public function findOneBySomeField($value): ?SuggestedCategory
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
