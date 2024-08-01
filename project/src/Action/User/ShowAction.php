<?php

namespace App\Action\User;

use App\Dto\User\ResponseDto;
use App\Repository\UserRepository;

class ShowAction
{
    public function __construct(private UserRepository $repo)
    {
    }

    public function __invoke(int $id): ResponseDto
    {
        $user = $this->repo->getUserWithAddressAndPhonesByUserId($id);

        return new ResponseDto($user);
    }
}
