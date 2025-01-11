<?php

namespace App\Action\Value;

use App\Entity\AttributeEntity;
use App\Entity\AttributeValue;
use App\Entity\ValueEntity;
use App\Repository\AttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AttributeValueRepository $repo
    ) {}

    public function __invoke(int $valueId, int $attributeId): void
    {
        $value = $this->em->getReference(ValueEntity::class, $valueId);
        $attribute = $this->em->getReference(AttributeEntity::class, $attributeId);

        if (! $this->repo->findOneBy(['attribute' => $attribute, 'value' => $value])) {
            $entity = (new AttributeValue())
                ->setAttribute($attribute)
                ->setValue($value);

            $this->em->persist($entity);
            $this->em->flush();
        }
    }
}
