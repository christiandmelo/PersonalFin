<?php

namespace App\Repository;

use App\Entity\CreditCardBill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CreditCardBill|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditCardBill|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditCardBill[]    findAll()
 * @method CreditCardBill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditCardBillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditCardBill::class);
    }

    // /**
    //  * @return CreditCardBill[] Returns an array of CreditCardBill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CreditCardBill
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
