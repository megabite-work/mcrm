<?php

namespace App\Action\MultiStore;

use App\Entity\User;
use App\Repository\MultiStoreRepository;
use Symfony\Bundle\SecurityBundle\Security;

class IndexAction
{
    public function __construct(
        private MultiStoreRepository $repo,
        private Security $security
        
    ) {
    }

    public function __invoke(User $owner): array
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            $multiStores = $this->repo->findAll();
        } else {
            $multiStores = $this->repo->findAllMultiStoresByOwner($owner);
        }
        return $multiStores;
    }
}
