<?php

namespace App\Action\Value;

use App\Entity\AttributeEntity;
use App\Entity\ValueEntity;
use App\Repository\AttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;

class DetachAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AttributeValueRepository $repo
    ) {}

    public function __invoke(int $valueId, int $attributeId): void
    {
        $value = $this->em->getReference(ValueEntity::class, $valueId);
        $attribute = $this->em->getReference(AttributeEntity::class, $attributeId);

        if ($entity = $this->repo->findOneBy(['attribute' => $attribute, 'value' => $value])) {
            $this->em->remove($entity);
            $this->em->flush();
        }
    }
}
