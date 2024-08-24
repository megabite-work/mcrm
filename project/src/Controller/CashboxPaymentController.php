<?php

namespace App\Controller;

use App\Action\CashboxPayment\CreateAction;
use App\Action\CashboxPayment\DeleteAction;
use App\Action\CashboxPayment\IndexAction;
use App\Action\CashboxPayment\ShowAction;
use App\Dto\CashboxPayment\RequestDto;
use App\Dto\CashboxPayment\RequestQueryDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/cashbox-payments', format: 'json')]
#[OA\Tag(name: 'CashboxPayment')]
class CashboxPaymentController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['cashbox_payment:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['cashbox_payment:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['cashbox_payment:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['cashbox_payment:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['cashbox_payment:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
