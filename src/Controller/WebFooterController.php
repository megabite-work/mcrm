<?php

namespace App\Controller;

use App\Action\WebFooter\CreateAction;
use App\Action\WebFooter\DeleteAction;
use App\Action\WebFooter\IndexAction;
use App\Action\WebFooter\ShowAction;
use App\Action\WebFooter\UpdateAction;
use App\Dto\WebFooter\RequestDto;
use App\Dto\WebFooter\RequestQueryDto;
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
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['web_footer:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['web_footer:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
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
