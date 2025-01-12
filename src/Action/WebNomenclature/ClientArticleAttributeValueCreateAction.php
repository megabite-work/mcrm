<?php

namespace App\Action\WebNomenclature;

use App\Dto\ClientArticleAttributeValue\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\ClientArticleAttribute;
use App\Entity\ClientArticleAttributeValue;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeValueCreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $webNomenclature = $this->em->getReference(WebNomenclature::class, $id);
        $attribute = $this->em->getReference(ClientArticleAttribute::class, $dto->clientArticleAttributeId);
        $entity = (new ClientArticleAttributeValue())
            ->setWebNomenclature($webNomenclature)
            ->setAttribute($attribute)
            ->setValue($dto->getValue());
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
