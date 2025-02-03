<?php

namespace App\Controller;

use App\Action\AttributeGroup\AssignAction;
use App\Action\AttributeGroup\CreateAction;
use App\Action\AttributeGroup\DeleteAction;
use App\Action\AttributeGroup\DetachAction;
use App\Action\AttributeGroup\IndexAction;
use App\Action\AttributeGroup\ShowAction;
use App\Action\AttributeGroup\UpdateAction;
use App\Dto\AttributeGroup\RequestDto;
use App\Dto\AttributeGroup\RequestQueryDto;
use App\Entity\AttributeGroup;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/attribute-groups', format: 'json')]
#[OA\Tag(name: 'Attribute Group')]
class AttributeGroupController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['attribute_group:index']], validationGroups: ['attribute_group:index'])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, AttributeGroup::class);
        
        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['attribute_group:create']], validationGroups: ['attribute_group:create'], type: RequestDto::class)] array $dtos, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dtos), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['attribute_group:update']], validationGroups: ['attribute_group:update'])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, AttributeGroup::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, AttributeGroup::class);
        $action($id);
        
        return $this->emptyResponse();
    }
}
