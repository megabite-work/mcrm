<?php

namespace App\Action\WebNomenclature;

use App\Dto\ClientArticleAttribute\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\ClientArticleAttribute;
use App\Entity\MultiStore;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeCreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(int $multiStoreId, string $article, RequestDto $dto): IndexDto
    {
        $multiStore = $this->em->getReference(MultiStore::class, $multiStoreId);
        $entity = (new ClientArticleAttribute())
            ->setMultiStore($multiStore)
            ->setArticle($article)
            ->setAttribute($dto->getAttribute());
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
