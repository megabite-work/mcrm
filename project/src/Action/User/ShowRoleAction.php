<?php

namespace App\Action\User;

use App\Entity\Role;

class ShowRoleAction
{
    public function __invoke(): array
    {
        return Role::getRoles();
    }
}
