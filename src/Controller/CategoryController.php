<?php

namespace App\Controller;

use App\Entity\Category;
use App\Helper\RequestDataExtractor;
use App\Repository\ClientRepository;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class CategoryController extends BaseController
{

    public function __construct(
        CategoryService $categoryService,
        RequestDataExtractor $requestDataExtractor,
        CategoryRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger,
        ClientRepository $clientRepository
    ) {
        parent::__construct(
            $categoryService, 
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
        /** @var Category $entity */
        $existingEntity = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $existingEntity->setName($entity->getName());
        $existingEntity->setShortName($entity->getShortName());

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'category_';
    }
}
