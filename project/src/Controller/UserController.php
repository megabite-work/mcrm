<?php

namespace App\Controller;

use App\Entity\User;
use App\Action\User\ShowAction;
use App\Action\User\IndexAction;
use App\Action\User\CreateAction;
use App\Action\User\DeleteAction;
use App\Action\User\UpdateAction;
use App\Dto\User\CreateRequestDto;
use App\Dto\User\UpdateRequestDto;
use App\Action\User\IsUniqueEmailAction;
use App\Action\User\ChangePasswordAction;
use App\Dto\User\ChangePasswordRequestDto;
use App\Action\User\IsUniqueUsernameAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route(path: '/api/users', format: 'json')]
class UserController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action): JsonResponse
    {
        return $this->json($action(), context: ['groups' => ['user:read']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id));
    }

    #[Route(path: '/me', methods: ['GET'])]
    public function me(#[CurrentUser] User $user): JsonResponse
    {
        return $this->json($user, context: ['groups' => ['user:read']]);
    }

    #[Route(path: '', methods: ['POST'])]
    public function create(#[MapRequestPayload] CreateRequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['user:read']]);
    }

    #[Route('/{id<\d+>}', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] UpdateRequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }

    #[Route(path: '/is-unique-email', methods: ['POST'])]
    public function isUniqueEmail(Request $request, IsUniqueEmailAction $action): JsonResponse
    {
        $email = $request->getPayload()->get('email');
        return $this->json(['isUnique' => $action($email)]);
    }

    #[Route(path: '/is-unique-username', methods: ['POST'])]
    public function IsUniqueUsername(Request $request, IsUniqueUsernameAction $action): JsonResponse
    {
        $username = $request->getPayload()->get('username');
        return $this->json(['isUnique' => $action($username)]);
    }

    #[Route('/change-password', methods: ['PUT', 'PATCH'])]
    public function changePassword(#[MapRequestPayload] ChangePasswordRequestDto $dto, #[CurrentUser] User $user, ChangePasswordAction $action): JsonResponse
    {
        return $this->json($action($user, $dto));
    }
}
