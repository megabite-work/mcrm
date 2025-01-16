<?php

namespace App\Controller;

use App\Action\WebCredential\ArticleAction;
use App\Action\WebCredential\CreateAction;
use App\Action\WebCredential\ShowAction;
use App\Action\WebCredential\UpdateAction;
use App\Dto\WebCredential\RequestDto;
use App\Entity\MultiStore;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-credentials', format: 'json')]
#[OA\Tag(name: 'WebCredential')]
class WebCredentialController extends AbstractController
{
    #[Route(path: '/{multi_store_id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $multiStoreId, ShowAction $action): JsonResponse
    {
        $this->existsValidate($multiStoreId, MultiStore::class);

        return $this->successResponse($action($multiStoreId));
    }

    #[Route(path: '', methods: ['POST'])]
    #[OA\Post(summary: 'Create web credential')]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_credential:create']], validationGroups: ['web_credential:create'])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/{multi_store_id<\d+>}', methods: ['POST'])]
    #[OA\Post(summary: 'Increment aticles count')]
    public function increment(int $multiStoreId, ArticleAction $action): JsonResponse
    {
        $this->existsValidate($multiStoreId, MultiStore::class);

        return $this->successResponse($action($multiStoreId));
    }

    #[Route('/{multi_store_id<\d+>}', methods: ['PATCH'])]
    #[OA\RequestBody(
        description: 'Your request body description',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'catalog_type', type: 'string', example: 'category'),
                new OA\Property(property: 'catalog_type_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1, 2, 3]),
                new OA\Property(
                    property: 'secrets',
                    type: 'array',
                    items: new OA\Items(
                        type: 'object',
                        properties: [
                            new OA\Property(property: 'type', type: 'string', example: 'instagram'),
                            new OA\Property(property: 'login', type: 'string', example: 'login'),
                            new OA\Property(property: 'password', type: 'string', example: 'secret'),
                        ],
                    ),
                ),
                new OA\Property(
                    property: 'social',
                    type: 'array',
                    items: new OA\Items(
                        type: 'object',
                        properties: [
                            new OA\Property(property: 'type', type: 'string', example: 'telegram'),
                            new OA\Property(property: 'url', type: 'string', example: 't.me/example'),
                            new OA\Property(property: 'header', type: 'boolean', example: true),
                            new OA\Property(property: 'footer', type: 'boolean', example: false),
                        ],
                    ),
                ),
                new OA\Property(property: 'buy_type', type: 'string', example: 'phone'),
                new OA\Property(property: 'buy_value', type: 'string', example: 'example'),
                new OA\Property(property: 'logo', type: 'string', example: 'https://example.com/logo.jpg'),
                new OA\Property(property: 'about', type: 'string', example: 'about'),
                new OA\Property(property: 'tmplate_id', type: 'integer', example: 1),
            ]
        )
    )]
    public function update(int $multiStoreId, #[MapRequestPayload(serializationContext: ['groups' => ['web_credential:update']], validationGroups: ['web_credential:update'])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($multiStoreId, MultiStore::class);

        return $this->successResponse($action($multiStoreId, $dto));
    }
}
