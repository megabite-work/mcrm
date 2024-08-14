<?php

namespace App\Action\UserCredential;

use App\Entity\User;
use App\Component\Paginator;
use App\Dto\UserCredential\RequestQueryDto;
use App\Repository\UserCredentialRepository;

class IndexAction
{
    public function __construct(
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(User $user, RequestQueryDto $dto): Paginator
    {
        $userCredentials = $this->repo->findAllUserCredentials($user, $dto);

        return $userCredentials;
    }
}
