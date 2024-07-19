<?php

namespace App\Controller;

use App\Action\User\IndexAction;
use App\Action\User\ShowAction;
use App\Action\User\CreateAction;
use App\Action\User\UpdateAction;
use App\Action\User\DeleteAction;
use App\Component\CurrentUser;
use App\Dto\User\CreateRequestDto;
use App\Dto\User\UpdateRequestDto;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/users', format: 'json')]
class UserController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action): JsonResponse
    {
        return $this->json($action(), context: ['groups' => ['user:read']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id));
    }

    #[Route(path: '/me', methods: ['GET'])]
    public function me(CurrentUser $user): JsonResponse
    {
        return $this->json($user->getUser(), context: ['groups' => ['user:read']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload] CreateRequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['user:read']]);
    }

    #[Route('/{id<\d+>}', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] UpdateRequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json($action($id));
    }
}
