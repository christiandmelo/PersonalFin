<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(
        UserRepository $repository,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->repository = $repository;
        $this->encoder = $encoder;
    }

    /**
     * @Route("/login", name="login")
     */
    public function index(Request $request)
    {
        $jsonData = json_decode($request->getContent());
        if (is_null($jsonData->user) || is_null($jsonData->password)) {
            return new JsonResponse([
                'erro' => 'please, send an user and password'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->repository->findOneBy([
            'username' => $jsonData->user
        ]);
        if (!$this->encoder->isPasswordValid($user, $jsonData->password)) {
            return  new JsonResponse([
                'erro' => 'User or password invalid'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = JWT::encode(['username' => $user->getUsername()], 'chave', 'HS256');

        return new JsonResponse([
            'access_token' => $token
        ]);
    }
}
