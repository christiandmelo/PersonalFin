<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    /**
     * @var bool
     */
    private $success;
    /**
     * @var int
     */
    private $currentPage;
    /**
     * @var int
     */
    private $itensPerPage;
    /**
     * @var string
     */
    private $response;
    /**
     * @var int
     */
    private $statusResponse;

    public function __construct(
        bool $success,
        $response,
        int $statusResponse = Response::HTTP_OK,
        int $currentPage = null,
        int $itensPerPage = null
    ) {
        $this->success = $success;
        $this->currentPage = $currentPage;
        $this->itensPerPage = $itensPerPage;
        $this->response = $response;
        $this->statusResponse = $statusResponse;
    }

    public function getResponse(): JsonResponse
    {
        $response = [
            'success' => $this->success,
            'currentPage' => $this->currentPage,
            'itensPerPage' => $this->itensPerPage,
            'response' => $this->response
        ];
        if (is_null($this->currentPage)) {
            unset($response['currentPage']);
            unset($response['itensPerPage']);
        }

        return new JsonResponse($response, $this->statusResponse);
    }
}
