<?php

namespace App\Controller;

use App\Action\Store\ShowAction;
use App\Action\Store\IndexAction;
use App\Action\Store\CreateAction;
use App\Action\Store\DeleteAction;
use App\Action\Store\UpdateAction;
use App\Dto\Store\CreateRequestDto;
use App\Dto\Store\UpdateRequestDto;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/stores', format: 'json')]
#[OA\Tag(name: 'Store')]
class StoreController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryParameter(filter: \FILTER_VALIDATE_INT)] int $multiStoreId, IndexAction $action): JsonResponse
    {
        return $this->json($action($multiStoreId), context: ['groups' => ['store:read']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['store:read']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload] CreateRequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['store:read']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload] UpdateRequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['store:read']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
