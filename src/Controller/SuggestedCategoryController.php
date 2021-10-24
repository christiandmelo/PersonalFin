<?php

namespace App\Controller;

use App\Entity\SuggestedCategory;
use App\Helper\RequestDataExtractor;
use App\Repository\SuggestedCategoryRepository;
use App\Service\SuggestedCategoryService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class SuggestedCategoryController extends BaseController
{
    public function __construct(
        SuggestedCategoryService $suggestedCategoryService,
        RequestDataExtractor $requestDataExtractor,
        SuggestedCategoryRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger
    ) {
        parent::__construct($suggestedCategoryService, $requestDataExtractor, $repository, $cache, $logger);
    }

    public function updateExistingEntity(int $id, $entity)
    {
        /** @var SuggestedCategory $entity */
        $existingEntity = $this->getDoctrine()->getRepository(SuggestedCategory::class)->find($id);

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'suggestedCategory_';
    }
}
