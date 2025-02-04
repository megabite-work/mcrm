<?php

namespace App\Action\Nomenclature;

use App\Dto\Nomenclature\IndexDto;
use App\Dto\Nomenclature\RequestDto;
use App\Entity\Category;
use App\Entity\Nomenclature;
use App\Entity\Unit;
use App\Exception\ErrorException;
use App\Repository\NomenclatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private NomenclatureRepository $repo
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
            throw new ErrorException('Nomenclature', $th->getMessage());
        }

        return $entities;
    }

    private function update(RequestDto $dto): IndexDto
    {
        $entity = $this->repo->findNomenclatureByIdWithMultiStore($dto->id);
        $this->updateCategory($entity, $dto);
        $this->updateUnit($entity, $dto);

        $entity->setQrCode($dto->qrCode ?? $entity->getQrCode())
            ->setMxik($dto->mxik ?? $entity->getMxik())
            ->setBrand($dto->brand ?? $entity->getBrand())
            ->setOldPrice($dto->oldPrice ?? $entity->getOldPrice())
            ->setPrice($dto->price  ?? $entity->getPrice())
            ->setOldPriceCourse($dto->oldPriceCourse ?? $entity->getOldPriceCourse())
            ->setPriceCourse($dto->priceCourse ?? $entity->getPriceCourse())
            ->setNds($dto->nds  ?? $entity->getNds())
            ->setDiscount($dto->discount ?? $entity->getDiscount());
        $this->barcode($entity, $dto->barcode);
        $this->name($entity, $dto);

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

    private function barcode(Nomenclature $nomenclature, ?int $barcode): void
    {
        $multiStore = $nomenclature->getMultiStore();
        if (
            null !== $barcode
            && ! $this->repo->findOneBy(['barcode' => $barcode, 'multiStore' => $multiStore, 'id' => $nomenclature->getId()])
        ) {
            if ($this->repo->findOneBy(['barcode' => $barcode, 'multiStore' => $multiStore])) {
                $barcode = $multiStore->getBarcodeTtn() + 1;
                $multiStore->setBarcodeTtn($barcode);
            }

            $nomenclature->setBarcode($barcode);
        }
    }

    private function name(Nomenclature $nomenclature, RequestDto $dto): void
    {
        if (! $this->repo->IsUniqueNameByMultiStore($dto, $nomenclature->getMultiStore()->getId())) {
            throw new ErrorException('Nomenclature', 'Name is not unique');
        }

        $nomenclature->setName($dto->getName());
    }
}
