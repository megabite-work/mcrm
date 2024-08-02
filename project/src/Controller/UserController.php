<?php

namespace App\Controller;

use App\Action\User\ChangePasswordAction;
use App\Action\User\CreateAction;
use App\Action\User\DeleteAction;
use App\Action\User\IndexAction;
use App\Action\User\IsUniqueEmailAction;
use App\Action\User\IsUniqueUsernameAction;
use App\Action\User\ShowAction;
use App\Action\User\ShowMeAction;
use App\Action\User\UpdateAction;
use App\Dto\User\ChangePasswordRequestDto;
use App\Dto\User\RequestDto;
use App\Dto\User\RequestQueryDto;
use App\Dto\User\UpdateRequestDto;
use App\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Operation;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route(path: '/api/users', format: 'json')]
#[OA\Tag(name: 'User')]
class UserController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    #[Operation(['summary' => 'Get all users', 'description' => 'lorem ipsum dolor set amet'])]
    #[OA\Response(
        response: 200,
        description: 'Returns the users',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: User::class, groups: ['user:index']))
        )
    )]
    public function index(IndexAction $action, #[MapQueryString(serializationContext: ['groups' => ['user:index']])] RequestQueryDto $dto): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['user:index']]);
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $this->json($action($id), context: ['groups' => ['user:show']]);
    }

    #[Route(path: '/me', methods: ['GET'])]
    public function me(#[CurrentUser] User $user, ShowMeAction $action): JsonResponse
    {
        return $this->json($action($user->getId()), context: ['groups' => ['user:me']]);
    }

    #[Route(path: '', methods: ['POST'])]
    #[Security(name: null)]
    public function create(#[MapRequestPayload(serializationContext: ['groups' => ['user:create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        return $this->json($action($dto), context: ['groups' => ['auth:read']]);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['user:update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        return $this->json($action($id, $dto), context: ['groups' => ['user:update']]);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $this->json(['success' => $action($id)]);
    }

    #[Route(path: '/is-unique-email', methods: ['POST'])]
    #[Security(name: null)]
    public function isUniqueEmail(Request $request, IsUniqueEmailAction $action): JsonResponse
    {
        $email = $request->getPayload()->get('email');

        return $this->json(['isUnique' => $action($email)]);
    }

    #[Route(path: '/is-unique-username', methods: ['POST'])]
    #[Security(name: null)]
    public function IsUniqueUsername(Request $request, IsUniqueUsernameAction $action): JsonResponse
    {
        $username = $request->getPayload()->get('username');

        return $this->json(['isUnique' => $action($username)]);
    }

    #[Route('/change-password', methods: ['PATCH'])]
    public function changePassword(#[MapRequestPayload] ChangePasswordRequestDto $dto, #[CurrentUser] User $user, ChangePasswordAction $action): JsonResponse
    {
        return $this->json($action($user, $dto), context: ['groups' => ['user:read']]);
    }
}
