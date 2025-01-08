<?php

namespace App\Controller;

use App\Action\UserCredential\CreateAction;
use App\Action\UserCredential\DeleteAction;
use App\Action\UserCredential\IndexAction;
use App\Action\UserCredential\ShowAction;
use App\Action\UserCredential\ShowByTypeAction;
use App\Action\UserCredential\UpdateAction;
use App\Dto\UserCredential\RequestDto;
use App\Entity\UserCredential;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/user-credentials', format: 'json')]
#[OA\Tag(name: 'UserCredential')]
class UserCredentialController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(IndexAction $action): JsonResponse
    {
        return $this->indexResponse($action($this->getUser()));
    }

    #[OA\Parameter(
        name: 'type',
        in: 'path',
        required: true,
        schema: new OA\Schema(
            type: 'string',
            enum: ['company', 'click', 'payme', 'uzum']
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Return the user credential by type',
        content: new OA\JsonContent(
            type: 'object',
            ref: new Model(type: UserCredential::class, groups: ['user_credential:index'])
        )
    )]
    #[Route(path: '/{type}', methods: ['GET'])]
    public function type(string $type, ShowByTypeAction $action): JsonResponse
    {
        return $this->successResponse($action($this->getUser(), $type));
    }

    #[Route(path: '/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, ShowAction $action): JsonResponse
    {
        $this->existsValidate($id, UserCredential::class);

        return $this->successResponse($action($this->getUser(), $id));
    }

    #[Route(path: '/company', methods: ['POST'])]
    public function company(#[MapRequestPayload(serializationContext: ['groups' => ['user_credential:company_create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        $dto->setType('company');

        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/click', methods: ['POST'])]
    public function click(#[MapRequestPayload(serializationContext: ['groups' => ['user_credential:click_create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        $dto->setType('click');

        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/payme', methods: ['POST'])]
    public function payme(#[MapRequestPayload(serializationContext: ['groups' => ['user_credential:payme_create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        $dto->setType('payme');

        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route(path: '/uzum', methods: ['POST'])]
    public function uzum(#[MapRequestPayload(serializationContext: ['groups' => ['user_credential:uzum_create']])] RequestDto $dto, CreateAction $action): JsonResponse
    {
        $dto->setType('uzum');

        return $this->successResponse($action($dto), Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}/company', methods: ['PATCH'])]
    public function updateCompany(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['user_credential:company_update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, UserCredential::class);
        $dto->setType('company');

        return $this->successResponse($action($this->getUser(), $id, $dto));
    }

    #[Route('/{id<\d+>}/click', methods: ['PATCH'])]
    public function updateClick(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['user_credential:click_update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, UserCredential::class);
        $dto->setType('click');

        return $this->successResponse($action($this->getUser(), $id, $dto));
    }

    #[Route('/{id<\d+>}/payme', methods: ['PATCH'])]
    public function updatePayme(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['user_credential:payme_update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, UserCredential::class);
        $dto->setType('payme');

        return $this->successResponse($action($this->getUser(), $id, $dto));
    }

    #[Route('/{id<\d+>}/uzum', methods: ['PATCH'])]
    public function updateUzum(int $id, #[MapRequestPayload(serializationContext: ['groups' => ['user_credential:uzum_update']])] RequestDto $dto, UpdateAction $action): JsonResponse
    {
        $this->existsValidate($id, UserCredential::class);
        $dto->setType('uzum');

        return $this->successResponse($action($this->getUser(), $id, $dto));
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        $this->existsValidate($id, UserCredential::class);
        $action($this->getUser(), $id);

        return $this->emptyResponse();
    }
}
