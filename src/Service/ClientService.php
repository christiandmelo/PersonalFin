<?php

namespace App\Service;

use App\Entity\Client;
use App\Helper\EntityFactoryException;
use App\Helper\EntityFactoryInterface;
use App\Repository\UserRepository;

class ClientService implements EntityFactoryInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createEntity(string $json, int $userId, bool $insert): Client
    {
        $objetoJson = json_decode($json);
        $this->checkAllProperties($objetoJson);

        $entity = new Client();
        $entity->setUser($this->userRepository->find($userId))
               ->setName($objetoJson->name)
               ->setEmail($objetoJson->email)
               ->setActive(true);

        return $entity;
    }

    private function checkAllProperties(object $objetoJson): void
    {
        if (!property_exists($objetoJson, 'name')) {
            throw new EntityFactoryException('Client needs a name');
        }

        if (!property_exists($objetoJson, 'email')) {
            throw new EntityFactoryException('Client needs an email');
        }
    }
}
