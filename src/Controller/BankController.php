<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Helper\RequestDataExtractor;
use App\Repository\ClientRepository;
use App\Repository\BankRepository;
use App\Service\BankService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class BankController extends BaseController
{

    public function __construct(
        BankService $bankService,
        RequestDataExtractor $requestDataExtractor,
        BankRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger,
        ClientRepository $clientRepository
    ) {
        parent::__construct(
            $bankService, 
            $requestDataExtractor, 
            $repository, 
            $cache, 
            $logger,
            $clientRepository
        );
    }

    public function updateExistingEntity(int $id, $entity)
    {
        $this->getUser();
        /** @var Bank $entity */
        $existingEntity = $this->getDoctrine()->getRepository(Bank::class)->find($id);
        $existingEntity->setName($entity->getName());

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'bank_';
    }
}
