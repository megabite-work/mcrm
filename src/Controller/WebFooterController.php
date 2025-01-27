<?php

namespace App\Controller;

use App\Action\WebFooter\CreateAction;
use App\Action\WebFooter\DeleteAction;
use App\Action\WebFooter\IndexAction;
use App\Action\WebFooter\ShowAction;
use App\Action\WebFooter\SortAction;
use App\Action\WebFooter\UpdateAction;
use App\Dto\WebFooter\RequestDto;
use App\Dto\WebFooter\RequestQueryDto;
use App\Dto\WebFooter\SortDto;
use App\Entity\WebFooter;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-footers', format: 'json')]
#[OA\Tag(name: 'WebFooter')]
class WebFooterController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_footer:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, WebFooter::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    #[OA\RequestBody(
        description: 'Your request body description',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'multi_store_id', type: 'integer', example: 1),
                new OA\Property(property: 'title', type: 'string', example: 'title'),
                new OA\Property(property: 'type', type: 'string', enum: ['about', 'link', 'contact', 'social'], example: 'about'),
                new OA\Property(property: 'order', type: 'integer', example: 1),
                new OA\Property(property: 'is_active', type: 'boolean', example: true),
                new OA\Property(
                    property: 'links',
                    type: 'array',
                    items: new OA\Items(
                        type: 'object',
                        properties: [
                            new OA\Property(property: 'title', type: 'string', example: 'title'),
                            new OA\Property(property: 'type', type: 'string', example: 'telegram'),
                            new OA\Property(property: 'url', type: 'string', example: 't.me/example'),
                            new OA\Property(property: 'is_active', type: 'boolean', example: true),
                        ],
                    ),
                ),
            ]
        )
    )]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_footer:create']], validationGroups: ['web_footer:create'])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/sort', methods: ['PATCH'])]
    public function sort(#[MapRequestPayload(type: SortDto::class)] array $dtos, SortAction $action): JsonResponse
    {
        $action($dtos);

        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    #[OA\RequestBody(
        description: 'Your request body description',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'title'),
                new OA\Property(property: 'type', type: 'string', enum: ['about', 'link', 'contact', 'social'], example: 'about'),
                new OA\Property(property: 'order', type: 'integer', example: 1),
                new OA\Property(property: 'is_active', type: 'boolean', example: true),
                new OA\Property(
                    property: 'links',
                    type: 'array',
                    items: new OA\Items(
                        type: 'object',
                        properties: [
                            new OA\Property(property: 'title', type: 'string', example: 'title'),
                            new OA\Property(property: 'type', type: 'string', example: 'telegram'),
                            new OA\Property(property: 'url', type: 'string', example: 't.me/example'),
                            new OA\Property(property: 'is_active', type: 'boolean', example: true),
                        ],
                    ),
                ),
            ]
        )
    )]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_footer:update']], validationGroups: ['web_footer:update'])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, WebFooter::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, WebFooter::class);
        $action($id);

        return $this->emptyResponse();
    }
}
