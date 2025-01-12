<?php

namespace App\Controller;

use App\Action\WebBlock\CreateAction;
use App\Action\WebBlock\DeleteAction;
use App\Action\WebBlock\IndexAction;
use App\Action\WebBlock\ShowAction;
use App\Action\WebBlock\SortAction;
use App\Action\WebBlock\UpdateAction;
use App\Dto\WebBlock\RequestDto;
use App\Dto\WebBlock\RequestQueryDto;
use App\Dto\WebBlock\SortDto;
use App\Entity\WebBlock;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-blocks', format: 'json')]
#[OA\Tag(name: 'WebBlock')]
class WebBlockController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_block:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBlock::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_block:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_block:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBlock::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/sort', methods: ['PATCH'])]
    public function sort(#[MapRequestPayload(type: SortDto::class)] array $dtos, SortAction $action): JsonResponse
    {
        $action($dtos);

        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBlock::class);
        $action($id);

        return $this->emptyResponse();
    }
}
