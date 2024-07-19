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

    #[Route(path: '/{id}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['user:read']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload] CreateRequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['user:read']]);
    }

    #[Route('/{id}', methods: ['PUT', 'PATCH'])]
    public function update(#[MapRequestPayload] UpdateRequestDto $dto, int $id, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['user:read']]);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json($action($id));
    }
}
