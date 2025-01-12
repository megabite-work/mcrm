<?php

namespace App\Action\WebNomenclature;

use App\Entity\MultiStore;
use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeDeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {}

    public function __invoke(int $multiStoreId, string $article, int $id): void
    {
        $multiStore = $this->em->getReference(MultiStore::class, $multiStoreId);
        $entity = $this->repo->findOneBy(['id' => $id, 'multiStore' => $multiStore, 'article' => $article]);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
