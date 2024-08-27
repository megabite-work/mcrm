<?php

namespace App\Controller;

use App\Action\Attribute\AssignAction;
use App\Action\Attribute\CreateAction;
use App\Action\Attribute\DeleteAction;
use App\Action\Attribute\DetachAction;
use App\Action\Attribute\IndexAction;
use App\Action\Attribute\ShowAction;
use App\Action\Attribute\UpdateAction;
use App\Dto\Attribute\RequestDto;
use App\Dto\Attribute\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/attributes', format: 'json')]
#[OA\Tag(name: 'Attribute')]
class AttributeController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['attribute:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['attribute:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['attribute:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['attribute:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['attribute:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['attribute:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['attribute:update']]);
    }

    #[Route('/{id<\d+>}/assign/{categoryId<\d+>}', methods: ['POST'])]
    public function assign(int $id, int $categoryId, AssignAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id, $categoryId)]);
    }

    #[Route('/{id<\d+>}/detach/{categoryId<\d+>}', methods: ['POST'])]
    public function detach(int $id, int $categoryId, DetachAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id, $categoryId)]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}