<?php

namespace App\Action\User;

use App\Dto\User\IndexDto;
use App\Repository\UserRepository;

class ShowMeAction
{
    public function __construct(
        private UserRepository $repo,
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromMeAction($this->repo->getUserByIdWithAllJoinedEntities($id));
    }
}
