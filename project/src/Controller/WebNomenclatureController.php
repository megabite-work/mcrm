<?php

namespace App\Controller;

use App\Action\WebNomenclature\ArticleAttributeAction;
use App\Action\WebNomenclature\AssignAction;
use App\Action\WebNomenclature\ClientArticleAttributeCreateAction;
use App\Action\WebNomenclature\ClientArticleAttributeDeleteAction;
use App\Action\WebNomenclature\ClientArticleAttributeIndexAction;
use App\Action\WebNomenclature\ClientArticleAttributeUpdateAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueCreateAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueDeleteAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueIndexAction;
use App\Action\WebNomenclature\ClientArticleAttributeValueUpdateAction;
use App\Action\WebNomenclature\CreateAction;
use App\Action\WebNomenclature\DeleteAction;
use App\Action\WebNomenclature\IndexAction;
use App\Action\WebNomenclature\ShowAction;
use App\Action\WebNomenclature\UpdateAction;
use App\Dto\WebNomenclature\RequestDto;
use App\Dto\WebNomenclature\RequestQueryDto;
use App\Entity\AttributeEntity;
use App\Entity\ClientArticleAttributeValue;
use App\Entity\MultiStore;
use App\Entity\WebNomenclature;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-nomenclatures', format: 'json')]
#[OA\Tag(name: 'WebNomenclature')]
class WebNomenclatureController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_nomenclature:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, WebNomenclature::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/assign', methods: ['POST'])]
    public function assign(#[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:assign']])] RequestDto $dto, AssignAction $action): JsonResponse
    {
        $action($dto);

        return $this->emptyResponse();
    }

    #[Route(path: '/article-attributes', methods: ['GET'])]
    public function article(#[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:article_attributes']])] RequestDto $dto, ArticleAttributeAction $action): JsonResponse
    {
        return $this->successResponse($action($dto));
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, WebNomenclature::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, WebNomenclature::class);
        $action($id);

        return $this->emptyResponse();
    }

    #[Route(path: '/{multi_store_id<\d+>}/client-article/{article}', methods: ['GET'])]
    public function clientArticleAttributeIndex(
        int $multiStoreId,
        string $article,
        ClientArticleAttributeIndexAction $action
    ): JsonResponse {
        $this->existsValidate($multiStoreId, MultiStore::class);

        return $this->indexResponse($action($multiStoreId, $article));
    }

    #[Route(path: '/{multi_store_id<\d+>}/client-article/{article}', methods: ['POST'])]
    public function clientArticleAttributeCreate(
        int $multiStoreId,
        string $article,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article']])] RequestDto $dto,
        ClientArticleAttributeCreateAction $action
    ): JsonResponse {
        $this->existsValidate($multiStoreId, MultiStore::class);

        return $this->successResponse($action($multiStoreId, $article, $dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/{multi_store_id<\d+>}/client-article/{article}/attribute/{attribute_id<\d+>}', methods: ['PATCH'])]
    public function clientArticleAttributeUpdate(
        int $multiStoreId,
        string $article,
        int $attributeId,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article']])] RequestDto $dto,
        ClientArticleAttributeUpdateAction $action
    ): JsonResponse {
        $this->existsValidate([$multiStoreId, $attributeId], [MultiStore::class, AttributeEntity::class]);

        return $this->successResponse($action($multiStoreId, $article, $attributeId, $dto));
    }

    #[Route(path: '/{multi_store_id<\d+>}/client-article/{article}/attribute/{attribute_id<\d+>}', methods: ['DELETE'])]
    public function clientArticleAttributeDelete(
        int $multiStoreId,
        string $article,
        int $attributeId,
        ClientArticleAttributeDeleteAction $action
    ): JsonResponse {
        $this->existsValidate([$multiStoreId, $attributeId], [MultiStore::class, AttributeEntity::class]);
        $action($multiStoreId, $article, $attributeId);

        return $this->emptyResponse();
    }

    #[Route(path: '/{id<\d+>}/client-article-value', methods: ['GET'])]
    public function clientArticleAttributeValueIndex(
        int $id,
        ClientArticleAttributeValueIndexAction $action
    ): JsonResponse {
        $this->existsValidate($id, WebNomenclature::class);

        return $this->indexResponse($action($id));
    }

    #[Route(path: '/{id<\d+>}/client-article-value', methods: ['POST'])]
    public function clientArticleAttributeValueCreate(
        int $id,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article_value_create']])] RequestDto $dto,
        ClientArticleAttributeValueCreateAction $action
    ): JsonResponse {
        $this->existsValidate($id, WebNomenclature::class);

        return $this->successResponse($action($id, $dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/{id<\d+>}/client-article-value/{value_id<\d+>}', methods: ['PATCH'])]
    public function clientArticleAttributeValueUpdate(
        int $id,
        int $valueId,
        #[MapRequestPayload(serializationContext: ['groups' => ['web_nomenclature:client_article_value_update']])] RequestDto $dto,
        ClientArticleAttributeValueUpdateAction $action
    ): JsonResponse {
        $this->existsValidate([$id, $valueId], [WebNomenclature::class, ClientArticleAttributeValue::class]);

        return $this->successResponse($action($id, $valueId, $dto));
    }

    #[Route(path: '/{id<\d+>}/client-article-value/{value_id<\d+>}', methods: ['DELETE'])]
    public function clientArticleAttributeValueDelete(
        int $id,
        int $valueId,
        ClientArticleAttributeValueDeleteAction $action
    ): JsonResponse {
        $this->existsValidate([$id, $valueId], [WebNomenclature::class, ClientArticleAttributeValue::class]);
        $action($id, $valueId);

        return $this->emptyResponse();
    }
}
