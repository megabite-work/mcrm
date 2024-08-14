<?php

namespace App\Action\MultiStore;

use App\Component\CurrentUser;
use App\Component\Paginator;
use App\Dto\MultiStore\RequestQueryDto;
use App\Repository\MultiStoreRepository;
use Symfony\Bundle\SecurityBundle\Security;

class IndexAction
{
    public function __construct(
        private MultiStoreRepository $repo,
        private Security $security,
        private CurrentUser $user
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            $multiStores = $this->repo->findAll();
        } else {
            $multiStores = $this->repo->findAllMultiStoresByOwnerWithPagination($this->user->getUser(), $dto);
        }

        return $multiStores;
    }
}
