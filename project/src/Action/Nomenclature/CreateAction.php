<?php

namespace App\Action\Nomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\Nomenclature\RequestDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\Nomenclature;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): Nomenclature
    {
        $category = $this->em->find(Category::class, $dto->getCategoryId());
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        if (null === $category || null === $multiStore) {
            throw new EntityNotFoundException('category or multiStore not found');
        }

        $nomenclature = $this->create($dto, $category, $multiStore);

        $this->em->persist($nomenclature);
        $this->em->flush();

        return $nomenclature;
    }

    private function create(RequestDto $dto, Category $category, MultiStore $multiStore): Nomenclature
    {
        $nomenclature = (new Nomenclature())
            ->setName($dto->getSerializedName())
            ->setMxik($dto->getMxik())
            ->setBrand($dto->getBrand())
            ->setOldPrice($dto->getOldPrice() ?? 0)
            ->setPrice($dto->getPrice() ?? 0)
            ->setOldPriceCourse($dto->getOldPriceCourse() ?? 0)
            ->setPriceCourse($dto->getPriceCourse() ?? 0)
            ->setNds($dto->getNds() ?? 0)
            ->setDiscount($dto->getDiscount() ?? 0)
            ->setMultiStore($multiStore)
            ->setCategory($category);

        $this->barcode($multiStore, $nomenclature, $dto->getBarcode());

        return $nomenclature;
    }

    private function barcode(MultiStore $multiStore, Nomenclature $nomenclature, ?int $barcode): void
    {
        if (null === $barcode) {
            $barcode = $multiStore->getBarcodeTtn() + 1;
            $multiStore->setBarcodeTtn($barcode);
        }

        $nomenclature->setBarcode($barcode);
    }
}
