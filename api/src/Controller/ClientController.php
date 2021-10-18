<?php

namespace App\Controller;

use App\Entity\Client;
use App\Helper\RequestDataExtractor;
use App\Repository\ClientRepository;
use App\Service\ClientService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class ClientController extends BaseController
{
    public function __construct(
        ClientService $clientService,
        RequestDataExtractor $requestDataExtractor,
        ClientRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger
    ) {
        parent::__construct($clientService, $requestDataExtractor, $repository, $cache, $logger);
    }

    public function updateExistingEntity(int $id, $entity)
    {
        /** @var Client $entity */
        $entity = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $entity->setName($entity->getName());
        $entity->setEmail($entity->getEmail());

        return $entity;
    }

    public function cachePrefix(): string
    {
        return 'client_';
    }
}
