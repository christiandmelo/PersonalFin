<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Helper\RequestDataExtractor;
use App\Repository\ClientRepository;
use App\Repository\EntryRepository;
use App\Service\EntryService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class EntryController extends BaseController
{

    public function __construct(
        EntryService $entryService,
        RequestDataExtractor $requestDataExtractor,
        EntryRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger,
        ClientRepository $clientRepository
    ) {
        parent::__construct(
            $entryService, 
            $requestDataExtractor, 
            $repository, 
            $cache, 
            $logger,
            $clientRepository
        );
    }

    public function updateExistingEntity(int $id, $entity)
    {
        /** @var Entry $entity */
        $existingEntity = $this->getDoctrine()->getRepository(Entry::class)->find($id);
        $existingEntity->setBankAccount($entity->getBankAccount());
        $existingEntity->setCategory($entity->getCategory());
        $existingEntity->setCreditCardBill($entity->getCreditCardBill());
        $existingEntity->setIssuanceDate($entity->getIssuanceDate());
        $existingEntity->setDueDate($entity->getDueDate());
        $existingEntity->setDateWithdrew($entity->getDateWithdrew());
        $existingEntity->setAmount($entity->getAmount());
        $existingEntity->setDebitedAmount($entity->getDebitedAmount());
        $existingEntity->setTypeEntry($entity->getTypeEntry());

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'entry_';
    }
}
