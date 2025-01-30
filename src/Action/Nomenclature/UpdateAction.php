<?php

namespace App\Action\Nomenclature;

use App\Dto\Nomenclature\IndexDto;
use App\Dto\Nomenclature\RequestDto;
use App\Entity\Category;
use App\Entity\Nomenclature;
use App\Entity\Unit;
use App\Exception\ErrorException;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(array $dtos): array
    {
        try {
            $this->em->beginTransaction();
            $entities = array_map(fn($dto): IndexDto => $this->update($dto), $dtos);
            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new ErrorException('Nomenclature', $th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function update(RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(Nomenclature::class, $dto->id);
        $this->updateCategory($entity, $dto);
        $this->updateUnit($entity, $dto);

        $entity->setQrCode($dto->qrCode ?? $entity->getQrCode())
            ->setBarcode($dto->barcode ?? $entity->getBarcode())
            ->setMxik($dto->mxik ?? $entity->getMxik())
            ->setBrand($dto->brand ?? $entity->getBrand())
            ->setOldPrice($dto->oldPrice ?? $entity->getOldPrice())
            ->setPrice($dto->price  ?? $entity->getPrice())
            ->setOldPriceCourse($dto->oldPriceCourse ?? $entity->getOldPriceCourse())
            ->setPriceCourse($dto->priceCourse ?? $entity->getPriceCourse())
            ->setNds($dto->nds  ?? $entity->getNds())
            ->setName([
                'ru' => $dto->nameRu ?? $entity->getName()['ru'],
                'uz' => $dto->nameUz ?? $entity->getName()['uz'],
                'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
            ])
            ->setDiscount($dto->discount ?? $entity->getDiscount());

        return IndexDto::fromEntity($entity);
    }

    private function updateCategory(Nomenclature $entity, RequestDto $dto): void
    {
        if ($dto->categoryId) {
            $entity->setCategory($this->em->getReference(Category::class, $dto->categoryId));
        }
    }

    private function updateUnit(Nomenclature $entity, RequestDto $dto): void
    {
        if ($dto->unitCode) {
            $entity->setUnit($this->em->getRepository(Unit::class)->findOneBy(['code' => $dto->unitCode]));
        }
    }
}
