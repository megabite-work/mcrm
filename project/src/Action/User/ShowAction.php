<?php

namespace App\Action\User;

use App\Dto\User\ShowResponseDto;
use App\Repository\UserRepository;

class ShowAction
{
    public function __construct(private UserRepository $repo)
    {
    }

    public function __invoke(int $id)/* : ShowResponseDto */
    {
        $user = $this->repo->getUserWithAddressAndPhonesByUserId($id);
        return $user;
        return new ShowResponseDto($user);
    }
}
