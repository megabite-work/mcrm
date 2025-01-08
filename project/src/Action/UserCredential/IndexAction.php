<?php

namespace App\Action\UserCredential;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\UserCredential\IndexDto;
use App\Repository\UserCredentialRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class IndexAction
{
    public function __construct(
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(UserInterface $user): ListResponseDtoInterface
    {
        $data = $this->repo->findAllUserCredentials($user);

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data);
    }
}
