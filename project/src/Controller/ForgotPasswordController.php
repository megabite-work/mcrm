<?php

namespace App\Controller;

use App\Action\User\ForgotPasswordAction;
use App\Action\User\ResetPasswordAction;
use App\Dto\ForgotPassword\RequestDto;
use App\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/auth', format: 'json')]
#[OA\Tag(name: 'Authorization')]
#[Security(name: null)]
class ForgotPasswordController extends AbstractController
{
    #[Route('/forgot', methods: ['POST'])]
    public function request(#[MapRequestPayload(serializationContext: ['groups' => ['forgot:password']])] RequestDto $dto, ForgotPasswordAction $action): JsonResponse
    {
        $action($dto);

        return $this->emptyResponse();
    }

    #[Route('/{token}/reset', methods: ['POST'])]
    public function reset(string $token, #[MapRequestPayload(serializationContext: ['groups' => ['reset:password']])] RequestDto $dto, ResetPasswordAction $action): JsonResponse
    {
        $this->existsValidate($token, User::class, 'token');
        $action($token, $dto);

        return $this->emptyResponse();
    }
}
