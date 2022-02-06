<?php

namespace App\Repository;

use App\Entity\Entry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Logging\DebugStack;

/**
 * @method Entry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entry[]    findAll()
 * @method Entry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entry::class);
    }

    public function getByDate(string $dtBegin, string $dtEnd, int $typeEntry, int $limit, int $firstResult){
        $debugStack = new DebugStack();
        $entityManager = $this->getEntityManager();
        $entityManager->getConfiguration()->setSQLLogger($debugStack);

        $whereType = "";
        if($typeEntry >= 0)
            $whereType = " AND entry.typeEntry = {$typeEntry}";

        $entry = Entry::class;
        $dql = "SELECT entry, bankAccount, status, category, payment, debtorClient
                FROM $entry entry 
                JOIN entry.bankAccount bankAccount 
                JOIN entry.status status
                JOIN entry.category category
                JOIN entry.payment payment
                LEFT JOIN entry.debtorClient debtorClient
                WHERE entry.issuanceDate >= '{$dtBegin} 00:00:00'
                    AND entry.issuanceDate <= '{$dtEnd} 23:59:59'
                    {$whereType}";

        $query = $entityManager->createQuery($dql)->setFirstResult( $firstResult )->setMaxResults( $limit );
        $entries = $query->getResult();

        return $entries;
    }
}
