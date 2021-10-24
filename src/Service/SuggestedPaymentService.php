<?php

namespace App\Service;

use App\Entity\SuggestedPayment;
use App\Helper\EntityFactoryInterface;

class SuggestedPaymentService implements EntityFactoryInterface
{
    public function createEntity(string $json, int $userId, bool $insert): SuggestedPayment
    {
        $entity = new SuggestedPayment();

        return $entity;
    }
}
