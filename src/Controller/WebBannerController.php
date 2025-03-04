<?php

namespace App\Controller;

use App\Action\WebBanner\CreateAction;
use App\Action\WebBanner\DeleteAction;
use App\Action\WebBanner\IndexAction;
use App\Action\WebBanner\ShowAction;
use App\Action\WebBanner\UpdateAction;
use App\Action\WebBanner\WebBannerMetrikaUpsertAction;
use App\Dto\WebBanner\RequestDto;
use App\Dto\WebBanner\RequestQueryDto;
use App\Dto\WebBanner\WebBannerMetrikaUpsertDto;
use App\Entity\WebBanner;
use App\Validator\Exists;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-banners', format: 'json')]
#[OA\Tag(name: 'WebBanner')]
class WebBannerController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Security(name: null)]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_banner:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBanner::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_banner:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_banner:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBanner::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBanner::class);
        $action($id);

        return $this->emptyResponse();
    }

    #[Route('/{id<\d+>}/metrics', methods: ['POST'])]
    public function metrics(int $id, #[MapRequestPayload] WebBannerMetrikaUpsertDto $dto, WebBannerMetrikaUpsertAction $action): JsonResponse
    {
        $this->validate($id, new Exists(entity: WebBanner::class, conditions: ['isActive' => ['operator' => '=', 'value' => true]]));
        $action($id, $dto);

        return $this->emptyResponse();
    }
}
