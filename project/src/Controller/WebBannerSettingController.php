<?php

namespace App\Controller;

use App\Action\WebBannerSetting\DeleteAction;
use App\Action\WebBannerSetting\IndexAction;
use App\Action\WebBannerSetting\ShowAction;
use App\Action\WebBannerSetting\UpdateAction;
use App\Dto\WebBannerSetting\RequestDto;
use App\Dto\WebBannerSetting\RequestQueryDto;
use App\Entity\WebBannerSetting;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/web-banner-settings', format: 'json')]
#[OA\Tag(name: 'WebBannerSettings')]
class WebBannerSettingController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(#[MapQueryString(serializationContext: ['groups' => ['web_banner_setting:index']])] RequestQueryDto $dto, IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    #[Security(name: null)]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBannerSetting::class);

        return $this->successResponse($action($id));
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBannerSetting::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, WebBannerSetting::class);
        $action($id);

        return $this->emptyResponse();
    }
}
