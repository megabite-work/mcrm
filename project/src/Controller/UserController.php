<?php

namespace App\Controller;

use App\Action\User\ChangePasswordAction;
use App\Action\User\CreateAction;
use App\Action\User\CreateUserAction;
use App\Action\User\CreateWorkerAction;
use App\Action\User\DeleteAction;
use App\Action\User\IndexAction;
use App\Action\User\IsUniqueEmailAction;
use App\Action\User\IsUniqueUsernameAction;
use App\Action\User\ShowAction;
use App\Action\User\ShowMeAction;
use App\Action\User\ShowRoleAction;
use App\Action\User\UpdateAction;
use App\Dto\User\IndexDto;
use App\Dto\User\RequestDto;
use App\Dto\User\RequestQueryDto;
use App\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route(path: '/api/users', format: 'json')]
#[OA\Tag(name: 'User')]
class UserController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action, #[MapQueryString(serializationContext: ['groups' => ['user:index']])] RequestQueryDto $dto): JsonResponse
    {
        return $this->indexResponse($action($dto));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, User::class);

        return $this->successResponse($action($id));
    }

    #[Route(path: '/me', methods: ['GET'])]
    public function me(#[CurrentUser] User $user, ShowMeAction $action): JsonResponse
    {
        return $this->successResponse($action($user->getId()));
    }

    #[Route(path: '/roles', methods: ['GET'])]
    public function roles(ShowRoleAction $action): JsonResponse
    {
        return $this->successResponse($action());
    }

    #[Route(path: '', methods: ['POST'])]
    #[Security(name: null)]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['user:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/create-user', methods: ['POST'])]
    #[Security(name: null)]
    public function createUser(#[MapRequestPayload(serializationContext: ['groups' => ['user:create_user']])] RequestDto $dto, CreateUserAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/create-worker', methods: ['POST'])]
    public function createWorker(#[MapRequestPayload(serializationContext: ['groups' => ['user:create_worker']])] RequestDto $dto, CreateWorkerAction $action): JsonResponse
    {
        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['user:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, User::class);

        return $this->successResponse($action($id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, User::class);
        $action($id);

        return $this->emptyResponse();
    }

    #[Route(path: '/is-unique-email', methods: ['POST'])]
    #[Security(name: null)]
    public function isUniqueEmail(#[MapRequestPayload(serializationContext: ['groups' => ['unique:email']])] RequestDto $dto, IsUniqueEmailAction $action): JsonResponse
    {
        return $this->successResponse(['unique' => $action($dto->email)]);
    }

    #[Route(path: '/is-unique-username', methods: ['POST'])]
    #[Security(name: null)]
    public function IsUniqueUsername(#[MapRequestPayload(serializationContext: ['groups' => ['unique:username']])] RequestDto $dto, IsUniqueUsernameAction $action): JsonResponse
    {
        return $this->successResponse(['unique' => $action($dto->username)]);
    }

    #[Route('/change-password', methods: ['PATCH'])]
    public function changePassword(#[MapRequestPayload(serializationContext: ['groups' => ['change:password']])] RequestDto $dto, #[CurrentUser] User $user, ChangePasswordAction $action): JsonResponse
    {
        $action($user, $dto);
        
        return $this->emptyResponse();
    }
}
