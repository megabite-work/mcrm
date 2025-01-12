<?php

namespace App\Action\UserCredential;

use App\Dto\UserCredential\IndexDto;
use App\Entity\UserCredential;
use App\Exception\ErrorException;
use App\Repository\UserCredentialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class ShowByTypeAction
{
    public function __construct(
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(UserInterface $user, string $type): IndexDto
    {
        if (!in_array($type, UserCredential::TYPES)) {
            throw new ErrorException(
                'UserCredential',
                'Available types: ' . "'" . implode("','", UserCredential::TYPES) . "'",
                Response::HTTP_BAD_REQUEST
            );
        }

        return IndexDto::fromEntity($this->repo->findUserCredentialByType($user, $type));
    }
}
