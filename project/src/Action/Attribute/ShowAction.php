<?php

namespace App\Action\Attribute;

use App\Component\EntityNotFoundException;
use App\Entity\AttributeEntity;
use App\Repository\AttributeEntityRepository;

class ShowAction
{
    public function __construct(private AttributeEntityRepository $repo)
    {
    }

    public function __invoke(int $id): AttributeEntity
    {
        $entity = $this->repo->find($id);

        if (null == $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
