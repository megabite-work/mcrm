<?php

namespace App\Controller;

use App\Action\Permission\AssignAction;
use App\Action\Permission\CreateAction;
use App\Action\Permission\DeleteAction;
use App\Action\Permission\IndexAction;
use App\Action\Permission\ShowAction;
use App\Action\Permission\UpdateAction;
use App\Dto\Permission\AssignDto;
use App\Dto\Permission\RequestDto;
use App\Dto\Permission\RequestQueryDto;
use App\Entity\Permission;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/permissions', format: 'json')]
#[OA\Tag(name: 'Permission')]
class PermissionController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['permission:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, Permission::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['permission:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['permission:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, Permission::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/assign', methods: ['POST'])]
    public function assign(#[MapRequestPayload(type: AssignDto::class)] array $dtos, AssignAction $action): JsonResponse
    {
        $action($dtos);

        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, Permission::class);
        $action($id);

        return $this->emptyResponse();
    }
}
