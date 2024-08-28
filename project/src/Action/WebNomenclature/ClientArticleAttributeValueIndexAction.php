<?php

namespace App\Action\WebNomenclature;

use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Repository\ClientArticleAttributeValueRepository;

class ClientArticleAttributeValueIndexAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeValueRepository $repo
    ) {}

    public function __invoke(int $id): array
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);

        if (null === $webNomenclature) {
            throw new EntityNotFoundException('web nomenclature not found');
        }

        $entities = $this->repo->findAllByWebNomenclatureWithAttribute($webNomenclature);

        return $entities;
    }
}
