<?php

namespace App\Action\Permission;

<<<<<<< HEAD
use App\Dto\Permission\IndexDto;
=======
use App\Component\EntityNotFoundException;
use App\Entity\Permission;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
use App\Repository\PermissionRepository;

class ShowAction
{
<<<<<<< HEAD
    public function __construct(
        private PermissionRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
=======
    public function __construct(private PermissionRepository $repo)
    {
    }

    public function __invoke(int $id): Permission
    {
        return $this->repo->find($id) ?? throw new EntityNotFoundException('not found');
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    }
}
