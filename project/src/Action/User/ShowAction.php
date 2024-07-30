<?php

namespace App\Action\User;

use App\Dto\User\ShowResponseDto;
use App\Repository\UserRepository;

class ShowAction
{
    public function __construct(private UserRepository $repo)
    {
    }

    public function __invoke(int $id): ShowResponseDto
    {
        $user = $this->repo->find($id);
        return new ShowResponseDto($user);
    }
}
