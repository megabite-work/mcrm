<?php

namespace App\Controller;

use App\Action\MultiStore\CreateAction;
use App\Action\MultiStore\DeleteAction;
use App\Action\MultiStore\IndexAction;
use App\Action\MultiStore\ShowAction;
use App\Action\MultiStore\UpdateAction;
use App\Dto\MultiStore\RequestDto;
use App\Dto\MultiStore\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/multi-stores', format: 'json')]
#[IsGranted('ROLE_DIRECTOR', statusCode: 403)]
#[OA\Tag(name: 'MultiStore')]
class MultiStoreController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['multi_store:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($this->getUser(), $dto), context: ['groups' => ['multi_stores:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['multi_store:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['multi_store:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($this->getUser(), $dto), context: ['groups' => ['multi_store:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['multi_store:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['multi_store:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
