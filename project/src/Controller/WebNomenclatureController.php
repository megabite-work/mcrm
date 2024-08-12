<?php

namespace App\Controller;

use OpenApi\Attributes as OA;
use App\Dto\WebNomenclature\RequestDto;
use App\Action\WebNomenclature\ShowAction;
use App\Action\WebNomenclature\IndexAction;
use Nelmio\ApiDocBundle\Annotation\Security;
use App\Action\WebNomenclature\CreateAction;
use App\Action\WebNomenclature\DeleteAction;
use App\Action\WebNomenclature\UpdateAction;
use App\Dto\WebNomenclature\RequestQueryDto;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/web-nomenclatures', format: 'json')]
#[OA\Tag(name: 'WebNomenclature')]
class WebNomenclatureController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_nomenclature:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_nomenclature:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['web_nomenclature:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['web_nomenclature:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['web_nomenclature:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
