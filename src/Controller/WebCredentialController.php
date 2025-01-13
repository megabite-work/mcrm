<?php

namespace App\Controller;

use App\Action\WebCredential\ArticleAction;
use App\Action\WebCredential\CreateAction;
use App\Action\WebCredential\ShowAction;
use App\Action\WebCredential\UpdateAction;
use App\Dto\WebCredential\RequestDto;
use App\Entity\MultiStore;
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
    public function show(int $multiStoreId, ShowAction $action): JsonResponse
    {
        $this->existsValidate($multiStoreId, MultiStore::class);

        return $this->successResponse($action($multiStoreId));
    }

    #[Route(path: '', methods: ['POST'])]
    #[OA\Post(summary: 'Create web credential')]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_credential:create']])] RequestDto $dto, CreateAction $action): JsonResponse
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
    // #[OA\RequestBody(
    //     description: 'Your request body description',
    //     content: new OA\JsonContent(
    //         properties: [
    //             new OA\Property(property: 'category', type: 'string', example: 'category'),
    //             new OA\Property(
    //                 property: 'secrets',
    //                 type: 'object',
    //                 properties: [
    //                     new OA\Property(
    //                         property: 'instagram',
    //                         type: 'object',
    //                         properties: [
    //                             new OA\Property(property: 'login', type: 'string', example: 'login'),
    //                             new OA\Property(property: 'password', type: 'string', example: 'secret'),
    //                         ]
    //                     ),
    //                 ]
    //             ),
    //             new OA\Property(
    //                 property: 'social',
    //                 type: 'object',
    //                 properties: [
    //                     new OA\Property(
    //                         property: 'telegram',
    //                         type: 'object',
    //                         properties: [
    //                             new OA\Property(property: 'url', type: 'string', example: 't.me/url'),
    //                             new OA\Property(property: 'isActive', type: 'boolean', example: true),
    //                         ]
    //                     ),
    //                     new OA\Property(
    //                         property: 'facebook',
    //                         type: 'object',
    //                         properties: [
    //                             new OA\Property(property: 'url', type: 'string', example: 'facebook.com/url'),
    //                             new OA\Property(property: 'isActive', type: 'boolean', example: true),
    //                         ]
    //                     ),
    //                 ]
    //             ),
    //         ]
    //     )
    // )]
    public function update(int $multiStoreId, #[MapRequestPayload(serializationContext: ['groups' => ['web_credential:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($multiStoreId, MultiStore::class);

        return $this->successResponse($action($multiStoreId, $dto));
    }
}
