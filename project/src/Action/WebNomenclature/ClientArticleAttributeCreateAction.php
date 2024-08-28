<?php

namespace App\Action\WebNomenclature;

use App\Entity\MultiStore;
use App\Entity\ClientArticleAttribute;
use App\Dto\WebNomenclature\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class ClientArticleAttributeCreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(int $multiStoreId, string $article, RequestDto $dto): ClientArticleAttribute
    {
        $multiStore = $this->em->find(MultiStore::class, $multiStoreId);

        if (null === $multiStore) {
            throw new EntityNotFoundException('multi store not found');
        }

        $entity = (new ClientArticleAttribute())
            ->setMultiStore($multiStore)
            ->setArticle($article)
            ->setAttribute($dto->getAttribute());

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}
