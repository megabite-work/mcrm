<?php

namespace App\Controller;

use App\Action\StoreNomenclature\CreateAction;
use App\Action\StoreNomenclature\DeleteAction;
use App\Action\StoreNomenclature\IndexAction;
use App\Action\StoreNomenclature\ShowAction;
use App\Action\StoreNomenclature\UpdateAction;
use App\Dto\StoreNomenclature\RequestDto;
use App\Dto\StoreNomenclature\RequestQueryDto;
use App\Entity\Nomenclature;
use App\Entity\Store;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/stores', format: 'json')]
#[OA\Tag(name: 'StoreNomenclature')]
class StoreNomenclatureController extends AbstractController
{
    #[Route(path: '/{store_id<\d+>}/nomenclatures', methods: ['GET'])]
    public function index(int $storeId, #[MapQueryString(serializationContext: ['groups' => ['store_nomenclature:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($storeId, $dto));
    }

    #[Route(path: '/{store_id<\d+>}/nomeclatures/{nomenclature_id<\d+>}', methods: ['GET'])]
    public function show(int $storeId, int $nomenclatureId, ShowAction $action): JsonResponse
    {
        $this->existsValidate([$storeId, $nomenclatureId], [Store::class, Nomenclature::class]);

        return $this->successResponse($action($storeId, $nomenclatureId));
    }

    #[Route(path: '/{store_id<\d+>}/nomenclatures', methods: ['POST'])]
    public function create(int $storeId, #[MapRequestPayload(serializationContext: ['groups' => ['store_nomenclature:create']], type: RequestDto::class)] array $dtos, CreateAction $action): JsonResponse
    {
        $this->existsValidate($storeId, Store::class);

        return $this->successResponse($action($storeId, $dtos), Response::HTTP_CREATED);
    }

    #[Route('/{store_id<\d+>}/nomeclatures/{nomenclature_id<\d+>}', methods: ['PATCH'])]
    public function update(int $storeId, int $nomenclatureId, #[MapRequestPayload(serializationContext: ['groups' => ['store_nomenclature:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate([$storeId, $nomenclatureId], [Store::class, Nomenclature::class]);

        return $this->successResponse($action($storeId, $nomenclatureId, $dto));
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access denied')]
    #[Route('/{store_id<\d+>}/nomeclatures/{nomenclature_id<\d+>}', methods: ['DELETE'])]
    public function delete(int $storeId, int $nomenclatureId, DeleteAction $action): JsonResponse
    {
        $this->existsValidate([$storeId, $nomenclatureId], [Store::class, Nomenclature::class]);
        $action($storeId, $nomenclatureId);

        return $this->emptyResponse();
    }
}
