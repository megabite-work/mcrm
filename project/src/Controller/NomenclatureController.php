<?php

namespace App\Controller;

use OpenApi\Attributes as OA;
use App\Dto\Nomenclature\RequestDto;
use App\Action\Nomenclature\ShowAction;
use App\Action\Nomenclature\IndexAction;
use App\Action\Nomenclature\CreateAction;
use App\Action\Nomenclature\DeleteAction;
use App\Action\Nomenclature\UpdateAction;
use App\Dto\Nomenclature\RequestQueryDto;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Action\Nomenclature\IsUniqueBarcodeByMultiStoreAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/nomenclatures', format: 'json')]
#[OA\Tag(name: 'Nomenclature')]
class NomenclatureController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['nomenclature:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['nomenclature:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['nomenclature:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['nomenclature:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['nomenclature:create']]);
    }

    #[Route(path: '/is-unique-barcode', methods: ['POST'])]
    public function isUniqueBarcode(#[MapRequestPayload(serializationContext: ['groups' => ['nomenclature:is_unique_barcode']])] RequestDto $dto, IsUniqueBarcodeByMultiStoreAction $action): JsonResponse
    {
        return $this->json($action($dto));
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['nomenclature:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['nomenclature:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}