<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\Bank;
use App\Helper\EntityFactoryException;
use App\Helper\EntityFactoryInterface;
use App\Repository\ClientRepository;
use App\Repository\BankRepository;

class BankService implements EntityFactoryInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var BankRepository
     */
    private $bankRepository;

    public function __construct(
        ClientRepository $clientRepository,
        BankRepository $bankRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->bankRepository = $bankRepository;
    }

    public function createEntity(string $json, int $userId, bool $insert): Bank
    {
        $objetoJson = json_decode($json);
        $this->checkAllProperties($objetoJson);

        $client = $this->getClient($userId);

        $this->validateIfInitialsAlreadyExist($insert, $client->getId(), $objetoJson->name);

        $entity = new Bank();
        $entity->setClient($client)
               ->setName($objetoJson->name)
               ->setActive(true);

        return $entity;
    }

    private function getClient(int $userId): Client
    {
        $client = $this->clientRepository->findBy(array('user' => $userId));
        if (count($client) <= 0) {
            throw new EntityFactoryException("User doesn't have a client registered");
        }

        return $client[0];
    }

    private function checkAllProperties(object $objetoJson): void
    {
        if (!property_exists($objetoJson, 'name')) {
            throw new EntityFactoryException('Bank needs a name');
        }
    }

    private function validateIfInitialsAlreadyExist(bool $insert, int $clientId, string $name): void
    {
        if(!$insert)
            return;

        $bank = $this->bankRepository->findBy(array('client' => $clientId, 'name' => $name));
        if (count($bank) > 0) {
            throw new EntityFactoryException("Bank alraedy exist with these name");
        }
    }
}
