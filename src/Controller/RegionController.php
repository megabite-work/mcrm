<?php

namespace App\Controller;

use App\Action\Region\IndexAction;
use App\Entity\Region;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/regions', format: 'json')]
#[OA\Tag(name: 'Region')]
class RegionController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action, #[MapQueryParameter] ?int $parentId = null): JsonResponse
    {
        $this->existsValidate($parentId, Region::class);

        return $this->indexResponse($action($parentId));
    }
}
