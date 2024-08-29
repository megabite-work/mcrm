<?php

namespace App\Controller;

use App\Action\Favorite\AssignAction;
use App\Action\Favorite\DetachAction;
use App\Action\Favorite\IndexAction;
use App\Component\CurrentUser;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/favorites', format: 'json')]
#[OA\Tag(name: 'Favorite')]
class FavoriteController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action, CurrentUser $user): JsonResponse
    {
        return $this->json($action($user->getUser()), context: ['groups' => ['favorite:index']]);
    }

    #[Route('/{webNomenclatureId<\d+>}/assign', methods: ['POST'])]
    public function assign(int $webNomenclatureId, CurrentUser $user, AssignAction $action): JsonResponse
    {
        return $this->json(['success' => $action($webNomenclatureId, $user->getUser())]);
    }

    #[Route('/{webNomenclatureId<\d+>}/detach', methods: ['POST'])]
    public function detach(int $webNomenclatureId, CurrentUser $user, DetachAction $action): JsonResponse
    {
        return $this->json(['success' => $action($webNomenclatureId, $user->getUser())]);
    }
}
