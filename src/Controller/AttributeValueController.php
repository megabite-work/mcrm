<?php

namespace App\Controller;

use App\Action\Value\AssignAction;
use App\Action\Value\CreateAction;
use App\Action\Value\DeleteAction;
use App\Action\Value\DetachAction;
use App\Action\Value\IndexAction;
use App\Action\Value\ShowAction;
use App\Action\Value\UpdateAction;
use App\Dto\Value\RequestDto;
use App\Dto\Value\RequestQueryDto;
use App\Entity\AttributeEntity;
use App\Entity\ValueEntity;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/values', format: 'json')]
#[OA\Tag(name: 'Attribute Value Entity')]
class AttributeValueController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['value:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, ValueEntity::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['value:create']], validationGroups: ['value:create'], type: RequestDto::class)] array $dtos, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dtos), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['value:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, ValueEntity::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}/assign/{attribute_id<\d+>}', methods: ['POST'])]
    public function assign(int $id, int $attributeId, AssignAction $action): JsonResponse
    {
        $this->existsValidate([$id, $attributeId], [ValueEntity::class, AttributeEntity::class]);
        $action($id, $attributeId);

        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}/detach/{attribute_id<\d+>}', methods: ['POST'])]
    public function detach(int $id, int $attributeId, DetachAction $action): JsonResponse
    {
        $this->existsValidate([$id, $attributeId], [ValueEntity::class, AttributeEntity::class]);
        $action($id, $attributeId);

        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, ValueEntity::class);
        $action($id);

        return $this->emptyResponse();
    }
}
