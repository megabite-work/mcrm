<?php

namespace App\Action\WebNomenclature;

use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Entity\WebNomenclature;
use App\Repository\ClientArticleAttributeValueRepository;

class ClientArticleAttributeValueDeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeValueRepository $repo
    ) {}

    public function __invoke(int $id, int $valueId): bool
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);
        $entity = $this->repo->findOneBy(['id' => $valueId, 'webNomenclature' => $webNomenclature]);

        if (null === $webNomenclature || null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($entity);
        $this->em->flush();

        return true;
    }
}
