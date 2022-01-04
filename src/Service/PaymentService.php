<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\Payment;
use App\Helper\EntityFactoryException;
use App\Helper\EntityFactoryInterface;
use App\Repository\ClientRepository;
use App\Repository\PaymentRepository;

class PaymentService implements EntityFactoryInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    public function __construct(
        ClientRepository $clientRepository,
        PaymentRepository $paymentRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function createEntity(string $json, int $userId, bool $insert): Payment
    {
        $objetoJson = json_decode($json);
        $this->checkAllProperties($objetoJson);

        $client = $this->getClient($userId);

        $this->validateIfInitialsAlreadyExist($insert, $client->getId(), $objetoJson->initials);

        $entity = new Payment();
        $entity->setClient($client)
               ->setName($objetoJson->name)
               ->setInitials($objetoJson->initials)
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
            throw new EntityFactoryException('Payment needs a name');
        }

        if (!property_exists($objetoJson, 'initials')) {
            throw new EntityFactoryException('Payment needs a initials');
        }
    }

    private function validateIfInitialsAlreadyExist(bool $insert, int $clientId, string $initials): void
    {
        if(!$insert)
            return;

        $payment = $this->paymentRepository->findBy(array('client' => $clientId, 'initials' => $initials));
        if (count($payment) > 0) {
            throw new EntityFactoryException("Payment alraedy exist with these initials");
        }
    }
}
