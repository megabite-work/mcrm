<?php

namespace App\Action\WebNomenclature;

use App\Entity\WebNomenclature;
use App\Repository\ClientArticleAttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeValueDeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeValueRepository $repo
    ) {}

    public function __invoke(int $id, int $valueId): void
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);
        $entity = $this->repo->findOneBy(['id' => $valueId, 'webNomenclature' => $webNomenclature]);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
