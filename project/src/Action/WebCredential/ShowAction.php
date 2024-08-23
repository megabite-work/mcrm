<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Entity\WebCredential;
use App\Repository\WebCredentialRepository;

class ShowAction
{
    public function __construct(private WebCredentialRepository $repo) {}

    public function __invoke(int $id): WebCredential
    {
        $entity = $this->repo->find($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
