<?php

namespace App\Controller;

use App\Service\ServiceInterface;
use App\Helper\DataExtractorRequest;
use App\Helper\ResponseFactory;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    /**
     * @var ObjectRepository
     */
    protected $repository;
    /**
     * @var ServiceInterface
     */
    protected $service;
    /**
     * @var DataExtractorRequest
     */
    private $dataExtractorRequest;

    public function __construct(
        EntityManagerInterface $entityManager,
        ObjectRepository $repository,
        ServiceInterface $service,
        DataExtractorRequest $dataExtractorRequest
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->service = $service;
        $this->dataExtractorRequest = $dataExtractorRequest;
    }

    public function new(Request $request): Response
    {
        $content = $request->getContent();
        $entity = $this->service->createEntity($content);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return new JsonResponse($entity);
    }

    public function getAll(Request $request)
    {
        $filter = $this->dataExtractorRequest->getDataFilter($request);
        $orderingInformation = $this->dataExtractorRequest->getOrderingData($request);
        [$currentPage, $itensPerPage] = $this->dataExtractorRequest->getPaginationData($request);

        $list = $this->repository->findBy(
            $filter,
            $orderingInformation,
            $itensPerPage,
            ($currentPage - 1) * $itensPerPage
        );
        $responseFactory = new ResponseFactory(
            true,
            $list,
            Response::HTTP_OK,
            $currentPage,
            $itensPerPage
        );
        return $responseFactory->getResponse();
    }

    public function getOne(int $id): Response
    {
        $entity = $this->repository->find($id);
        $statusResponse = is_null($entity)
            ? Response::HTTP_NO_CONTENT
            : Response::HTTP_OK;
        $responseFactory = new ResponseFactory(
            true,
            $entity,
            $statusResponse
        );

        return $responseFactory->getResponse();
    }

    public function remove(int $id): Response
    {
        $entity = $this->repository->find($id);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    public function update(int $id, Request $request): Response
    {
        $content = $request->getContent();
        $entity = $this->service->createEntity($content);

        try {
            $existingEntity = $this->atualizaEntidadeExistente($id, $entity);
            $this->entityManager->flush();

            $responseFactory = new ResponseFactory(
                true,
                $existingEntity,
                Response::HTTP_OK
            );
            return $responseFactory->getResponse();
        } catch (\InvalidArgumentException $ex) {
            $responseFactory = new ResponseFactory(
                false,
                'Resource not found
                
                ',
                Response::HTTP_NOT_FOUND
            );
            return $responseFactory->getResponse();
        }
    }

    abstract function atualizaEntidadeExistente(int $id, $entity);
}
