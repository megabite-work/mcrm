<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Entity\WebBanner;
use App\Repository\WebBannerRepository;

class ShowAction
{
    public function __construct(private WebBannerRepository $repo)
    {
    }

    public function __invoke(int $id): WebBanner
    {
        $entity = $this->repo->find($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
