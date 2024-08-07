<?php

namespace App\Controller;

use App\Action\ForgiveType\CreateAction;
use App\Action\ForgiveType\DeleteAction;
use App\Action\ForgiveType\IndexAction;
use App\Action\ForgiveType\ShowAction;
use App\Action\ForgiveType\UpdateAction;
use App\Dto\ForgiveType\RequestDto;
use App\Dto\ForgiveType\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/forgive-types', format: 'json')]
#[OA\Tag(name: 'ForgiveType')]
class ForgiveTypeController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['forgive_type:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['forgive_type:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['forgive_type:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['forgive_type:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['forgive_type:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['forgive_type:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['forgive_type:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
