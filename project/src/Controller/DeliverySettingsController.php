<?php

namespace App\Controller;

use OpenApi\Attributes as OA;
use App\Dto\DeliverySettings\RequestDto;
use App\Action\DeliverySettings\ShowAction;
use App\Action\DeliverySettings\IndexAction;
use App\Action\DeliverySettings\CreateAction;
use App\Action\DeliverySettings\DeleteAction;
use App\Action\DeliverySettings\UpdateAction;
use App\Dto\DeliverySettings\RequestQueryDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints as Assert;

#[Route(path: '/api/delivery-settings', format: 'json')]
#[OA\Tag(name: 'DeliverySettings')]
class DeliverySettingsController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['delivery_settings:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['delivery_settings:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['delivery_settings:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['delivery_settings:create']], type: RequestDto::class)] array $dtos, CreateAction $action): JsonResponse
    {
        return $this->json($action($dtos), context: ['groups' => ['delivery_settings:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['delivery_settings:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['delivery_settings:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
