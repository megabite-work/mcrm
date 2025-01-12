<?php

namespace App\Action\Permission;

use App\Dto\Permission\IndexDto;
use App\Repository\PermissionRepository;

class ShowAction
{
    public function __construct(
        private PermissionRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
