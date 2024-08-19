<?php

namespace App\Controller;

use App\Action\CashboxShift\CreateAction;
use App\Action\CashboxShift\DeleteAction;
use App\Action\CashboxShift\IndexAction;
use App\Action\CashboxShift\ShowAction;
use App\Action\CashboxShift\UpdateAction;
use App\Dto\CashboxShift\RequestDto;
use App\Dto\CashboxShift\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/cashbox-shift', format: 'json')]
#[OA\Tag(name: 'CashboxShift')]
class CashboxShiftController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['cashbox_shift:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['cashbox_shift:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['cashbox_shift:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['cashbox_shift:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['cashbox_shift:create']]);
    }

    #[Route('/{id<\d+>}/closed', methods: ['PATCH'])]
    public function update(int $id, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['cashbox_shift:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
