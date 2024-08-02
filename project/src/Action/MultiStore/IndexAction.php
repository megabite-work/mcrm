<?php

namespace App\Action\MultiStore;

use App\Component\Paginator;
use App\Dto\MultiStore\RequestQueryDto;
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

    public function __invoke(User $owner, RequestQueryDto $dto): Paginator
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            $multiStores = $this->repo->findAll();
        } else {
            $multiStores = $this->repo->findAllMultiStoresByOwnerWithPagination($owner, $dto->getPage(), $dto->getPerPage());
        }

        return $multiStores;
    }
}
