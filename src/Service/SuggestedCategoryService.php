<?php

namespace App\Service;

use App\Entity\SuggestedCategory;
use App\Helper\EntityFactoryInterface;

class SuggestedCategoryService implements EntityFactoryInterface
{
    public function createEntity(string $json, int $userId, bool $insert): SuggestedCategory
    {
        $entity = new SuggestedCategory();

        return $entity;
    }
}
