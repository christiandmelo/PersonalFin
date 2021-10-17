<?php

namespace App\Repository;

use App\Entity\RecurringEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecurringEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecurringEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecurringEntry[]    findAll()
 * @method RecurringEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecurringEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecurringEntry::class);
    }

    // /**
    //  * @return RecurringEntry[] Returns an array of RecurringEntry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecurringEntry
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
