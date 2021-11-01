<?php

namespace App\Controller;

use App\Entity\CreditCard;
use App\Helper\RequestDataExtractor;
use App\Repository\ClientRepository;
use App\Repository\CreditCardRepository;
use App\Service\CreditCardService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class CreditCardController extends BaseController
{

    public function __construct(
        CreditCardService $creditCardService,
        RequestDataExtractor $requestDataExtractor,
        CreditCardRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger,
        ClientRepository $clientRepository
    ) {
        parent::__construct(
            $creditCardService, 
            $requestDataExtractor, 
            $repository, 
            $cache, 
            $logger,
            $clientRepository
        );
    }

    public function updateExistingEntity(int $id, $entity)
    {
        /** @var CreditCard $entity */
        $existingEntity = $this->getDoctrine()->getRepository(CreditCard::class)->find($id);
        $existingEntity->setName($entity->getName());
        $existingEntity->setClosingDay($entity->getClosingDay());
        $existingEntity->setDueDate($entity->getDueDate());
        $existingEntity->setAmountLimit($entity->getAmountLimit());
        $existingEntity->setDisplayInSummary($entity->getDisplayInSummary());

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'creditCard_';
    }
}
