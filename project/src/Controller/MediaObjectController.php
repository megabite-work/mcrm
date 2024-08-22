<?php

namespace App\Controller;

use OpenApi\Attributes as OA;
use App\Action\Cashbox\CreateAction;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/cashboxes', format: 'json')]
#[OA\Tag(name: 'Cashbox')]
class MediaObjectController extends AbstractController
{
    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapUploadedFile] UploadedFile $file, CreateAction $action): JsonResponse
    {
        return $this->json($action($file));
    }
}
