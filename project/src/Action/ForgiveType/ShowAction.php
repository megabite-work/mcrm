<?php

namespace App\Action\ForgiveType;

use App\Component\EntityNotFoundException;
use App\Entity\ForgiveType;
use App\Repository\ForgiveTypeRepository;

class ShowAction
{
    public function __construct(private ForgiveTypeRepository $repo)
    {
    }

    public function __invoke(int $id): ForgiveType
    {
        $forgiveType = $this->repo->findForgiveTypeById($id);

        if (null === $forgiveType) {
            throw new EntityNotFoundException('not found');
        }

        return $forgiveType;
    }
}
