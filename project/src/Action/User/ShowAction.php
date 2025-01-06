<?php

namespace App\Action\User;

use App\Dto\User\IndexDto;
use App\Repository\UserRepository;

class ShowAction
{
    public function __construct(
        private UserRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromShowAction($this->repo->getUserWithAddressAndPhonesByUserId($id));
    }
}
