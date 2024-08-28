<?php

namespace App\Action\WebNomenclature;

use App\Entity\WebNomenclature;
use App\Entity\ClientArticleAttribute;
use App\Dto\WebNomenclature\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Entity\ClientArticleAttributeValue;

class ClientArticleAttributeValueCreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(int $id, RequestDto $dto): ClientArticleAttributeValue
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);
        $attribute = $this->em->find(ClientArticleAttribute::class, $dto->getClientArticleAttributeId());

        if (null === $webNomenclature || null === $attribute) {
            throw new EntityNotFoundException('web nomenclature or attribute not found');
        }

        $entity = (new ClientArticleAttributeValue())
            ->setWebNomenclature($webNomenclature)
            ->setAttribute($attribute)
            ->setValue($dto->getValue());

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}
