<?php

namespace App\Controller;

use OpenApi\Attributes as OA;
use App\Dto\Category\RequestDto;
use App\Action\Category\ShowAction;
use App\Action\Category\IndexAction;
use App\Action\Category\CreateAction;
use App\Action\Category\DeleteAction;
use App\Action\Category\UpdateAction;
use App\Dto\Category\RequestQueryDto;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/categories', format: 'json')]
#[OA\Tag(name: 'Category')]
class CategoryController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['category:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['category:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['category:show']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['category:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['category:create']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['category:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['category:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }
}
