<?php

namespace App\Action\User;

use App\Dto\User\ShowResponseDto;
use App\Repository\UserRepository;

class ShowAction
{
    public function __construct(private UserRepository $userRepo)
    {
    }

    public function __invoke(int $id): ShowResponseDto
    {
        $user = $this->userRepo->find($id);
        return new ShowResponseDto($user);
    }
}
