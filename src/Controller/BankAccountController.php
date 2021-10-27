<?php

namespace App\Controller;

use App\Entity\BankAccount;
use App\Helper\RequestDataExtractor;
use App\Repository\ClientRepository;
use App\Repository\BankAccountRepository;
use App\Service\BankAccountService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class BankAccountController extends BaseController
{

    public function __construct(
        BankAccountService $bankAccountService,
        RequestDataExtractor $requestDataExtractor,
        BankAccountRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger,
        ClientRepository $clientRepository
    ) {
        parent::__construct(
            $bankAccountService, 
            $requestDataExtractor, 
            $repository, 
            $cache, 
            $logger,
            $clientRepository
        );
    }

    public function updateExistingEntity(int $id, $entity)
    {
        /** @var BankAccount $entity */
        $existingEntity = $this->getDoctrine()->getRepository(BankAccount::class)->find($id);
        $existingEntity->setName($entity->getName());
        $existingEntity->setInvestment($entity->getInvestment());
        $existingEntity->setDisplayInSummary($entity->getDisplayInSummary());

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'bankAccount_';
    }
}
