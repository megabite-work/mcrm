<?php

namespace App\Controller;

use App\Entity\User;
use App\Action\MultiStore\ShowAction;
use App\Action\MultiStore\IndexAction;
use App\Action\MultiStore\CreateAction;
use App\Action\MultiStore\DeleteAction;
use App\Action\MultiStore\UpdateAction;
use App\Dto\MultiStore\CreateRequestDto;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/multi-stores', format: 'json')]
#[IsGranted('ROLE_DIRECTOR', statusCode: 403)]
class MultiStoreController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[CurrentUser] User $user, IndexAction $action): JsonResponse
    {
        return $this->json($action($user), context: ['groups' => ['multi_store:read']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['multi_store:read']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload] CreateRequestDto $dto, #[CurrentUser] User $user, CreateAction $action): JsonResponse
    {
        return $this->json($action($user, $dto), context: ['groups' => ['multi_store:read']]);
    }

    #[Route('/{id<\d+>}', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] CreateRequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['multi_store:read']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
