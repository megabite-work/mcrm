<?php

namespace App\Action\WebNomenclature;

use App\Dto\ClientArticleAttribute\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\MultiStore;
use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeUpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {}

    public function __invoke(int $multiStoreId, string $article, int $id, RequestDto $dto): IndexDto
    {
        $multiStore = $this->em->find(MultiStore::class, $multiStoreId);
        $entity = $this->repo->findOneBy(['id' => $id, 'multiStore' => $multiStore, 'article' => $article]);
        $entity->setAttribute([
            'ru' => $dto->attributeRu ?? $entity->getAttribute()['ru'],
            'uz' => $dto->attributeUz ?? $entity->getAttribute()['uz'],
            'uzc' => $dto->attributeUzc ?? $entity->getAttribute()['uzc'],
        ]);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
