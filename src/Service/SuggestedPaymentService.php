<?php

namespace App\Service;

use App\Entity\SuggestedPayment;
use App\Helper\EntityFactoryInterface;
use App\Repository\UserRepository;

class SuggestedPaymentService implements EntityFactoryInterface
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createEntity(string $json): SuggestedPayment
    {
        $entity = new SuggestedPayment();

        return $entity;
    }
}
