<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\WebAttributeValue;
use App\Entity\WebNomenclature;
use App\Repository\AttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AttributeValueRepository $attributeValueRepository
    ) {}

    public function __invoke(RequestDto $dto): bool
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $dto->getWebNomenclatureId());
        $attributeValues = $this->attributeValueRepository->findAllByItem($dto->getAttributeValues());

        if (null === $webNomenclature || count($attributeValues) <= 0) {
            throw new EntityNotFoundException('web nomenclature or attribute values not found');
        }

        foreach ($attributeValues as $attributeValue) {
            $entity = (new WebAttributeValue())
                ->setWebNomenclature($webNomenclature)
                ->setAttributeValue($attributeValue);

            $this->em->persist($entity);
        }

        $this->em->flush();

        return true;
    }
}
