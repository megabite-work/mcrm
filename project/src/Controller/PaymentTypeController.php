<?php

namespace App\Controller;

use App\Action\PaymentType\CreateAction;
use App\Action\PaymentType\DeleteAction;
use App\Action\PaymentType\IndexAction;
use App\Action\PaymentType\ShowAction;
use App\Action\PaymentType\UpdateAction;
use App\Dto\PaymentType\RequestDto;
use App\Entity\PaymentType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/payment-types', format: 'json')]
#[OA\Tag(name: 'PaymentType')]
class PaymentTypeController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action());
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, PaymentType::class);

        return $this->successResponse($action($id));
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['payment_type:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['payment_type:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, PaymentType::class);

        return $this->successResponse($action($id, $dto));
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: 'Access Denied')]
    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, PaymentType::class);
        $action($id);

        return $this->emptyResponse();
    }
}
