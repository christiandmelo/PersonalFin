<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\Category;
use App\Helper\EntityFactoryException;
use App\Helper\EntityFactoryInterface;
use App\Repository\ClientRepository;
use App\Repository\CategoryRepository;

class CategoryService implements EntityFactoryInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        ClientRepository $clientRepository,
        CategoryRepository $categoryRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function createEntity(string $json, int $userId, bool $insert): Category
    {
        $objetoJson = json_decode($json);
        $this->checkAllProperties($objetoJson);

        $client = $this->getClient($userId);

        $this->validateIfNameAlreadyExist($insert, $client->getId(), $objetoJson->name);

        $entity = new Category();
        $entity->setClient($client)
               ->setName($objetoJson->name)
               ->setColor($objetoJson->color)
               ->setIcon($objetoJson->icon)
               ->setType($objetoJson->type)
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
            throw new EntityFactoryException('Category needs a name');
        }

        if (!property_exists($objetoJson, 'color')) {
            throw new EntityFactoryException('Category needs a color');
        }

        if (!property_exists($objetoJson, 'icon')) {
            throw new EntityFactoryException('Category needs an icon');
        }

        if (!property_exists($objetoJson, 'type')) {
            throw new EntityFactoryException('Category needs a type');
        }
    }

    private function validateIfNameAlreadyExist(bool $insert, int $clientId, string $name): void
    {
        if(!$insert)
            return;

        $category = $this->categoryRepository->findBy(array('client' => $clientId, 'name' => $name));
        if (count($category) > 0) {
            throw new EntityFactoryException("Category already exist with these name");
        }
    }
}
