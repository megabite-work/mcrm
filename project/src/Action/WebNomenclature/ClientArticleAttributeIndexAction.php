<?php

namespace App\Action\WebNomenclature;

use App\Entity\MultiStore;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Repository\ClientArticleAttributeRepository;

class ClientArticleAttributeIndexAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {}

    public function __invoke(int $multiStoreId, string $article): array
    {
        $multiStore = $this->em->find(MultiStore::class, $multiStoreId);

        if (null === $multiStore) {
            throw new EntityNotFoundException('multi store not found');
        }

        $entities = $this->repo->findBy(['multiStore' => $multiStore, 'article' => $article]);

        return $entities;
    }
}
