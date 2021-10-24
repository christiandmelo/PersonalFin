<?php

namespace App\Controller;

use App\Entity\SuggestedPayment;
use App\Helper\RequestDataExtractor;
use App\Repository\SuggestedPaymentRepository;
use App\Service\SuggestedPaymentService;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

class SuggestedPaymentController extends BaseController
{
    public function __construct(
        SuggestedPaymentService $suggestedPaymentService,
        RequestDataExtractor $requestDataExtractor,
        SuggestedPaymentRepository $repository,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger
    ) {
        parent::__construct($suggestedPaymentService, $requestDataExtractor, $repository, $cache, $logger);
    }

    public function updateExistingEntity(int $id, $entity)
    {
        /** @var SuggestedPayment $entity */
        $existingEntity = $this->getDoctrine()->getRepository(SuggestedPayment::class)->find($id);

        return $existingEntity;
    }

    public function cachePrefix(): string
    {
        return 'suggestedPayment_';
    }
}
