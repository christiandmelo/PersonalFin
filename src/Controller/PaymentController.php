<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Helper\RequestDataExtractor;
use App\Repository\ClientRepository;
use App\Repository\PaymentRepository;
use App\Service\PaymentService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class PaymentController extends BaseController
{

    public function __construct(
        PaymentService $paymentService,
        RequestDataExtractor $requestDataExtractor,
        PaymentRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger,
        ClientRepository $clientRepository
    ) {
        parent::__construct(
            $paymentService, 
            $requestDataExtractor, 
            $repository, 
            $cache, 
            $logger,
            $clientRepository
        );
    }

    public function updateExistingEntity(int $id, $entity)
    {
        /** @var Payment $entity */
        $existingEntity = $this->getDoctrine()->getRepository(Payment::class)->find($id);
        $existingEntity->setName($entity->getName());
        $existingEntity->setInitials($entity->getInitials());

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'payment_';
    }
}
