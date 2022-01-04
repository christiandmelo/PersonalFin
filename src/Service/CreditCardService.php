<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\CreditCard;
use App\Helper\EntityFactoryException;
use App\Helper\EntityFactoryInterface;
use App\Repository\ClientRepository;
use App\Repository\CreditCardRepository;

class CreditCardService implements EntityFactoryInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var CreditCardRepository
     */
    private $creditCardRepository;

    public function __construct(
        ClientRepository $clientRepository,
        CreditCardRepository $creditCardRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->creditCardRepository = $creditCardRepository;
    }

    public function createEntity(string $json, int $userId, bool $insert): CreditCard
    {
        $objetoJson = json_decode($json);
        $this->checkAllProperties($objetoJson);

        $client = $this->getClient($userId);

        $this->validateIfNameAlreadyExist($insert, $client->getId(), $objetoJson->name);

        $dueDate = strtotime($objetoJson->dueDate);

        $entity = new CreditCard();
        $entity->setClient($client)
               ->setName($objetoJson->name)
               ->setClosingDay($objetoJson->closingDay)
               //->setDueDate($dueDate)
               ->setAmountLimit($objetoJson->amountLimit)
               ->setDisplayInSummary($objetoJson->displayInSummary)
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
            throw new EntityFactoryException('Credit Card needs a name');
        }

        if (!property_exists($objetoJson, 'closingDay')) {
            throw new EntityFactoryException('Credit Card needs a closing day');
        }

        if (!property_exists($objetoJson, 'dueDate')) {
            throw new EntityFactoryException('Credit Card needs a due date');
        }

        if (!property_exists($objetoJson, 'amountLimit')) {
            throw new EntityFactoryException('Credit Card needs an amount limit');
        }

        if (!property_exists($objetoJson, 'displayInSummary')) {
            throw new EntityFactoryException('Credit Card needs a display in summary');
        }
    }

    private function validateIfNameAlreadyExist(bool $insert, int $clientId, string $name): void
    {
        if(!$insert)
            return;

        $creditCard = $this->creditCardRepository->findBy(array('client' => $clientId, 'name' => $name));
        if (count($creditCard) > 0) {
            throw new EntityFactoryException("Credit Card alraedy exist with these name");
        }
    }
}
