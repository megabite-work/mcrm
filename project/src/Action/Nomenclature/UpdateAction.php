<?php

namespace App\Action\Nomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\Nomenclature\RequestDto;
use App\Entity\Category;
use App\Entity\Nomenclature;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): Nomenclature
    {
        $nomenclature = $this->em->find(Nomenclature::class, $id);

        if (null === $nomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $nomenclature = $this->updateNomenclature($dto, $nomenclature);

        $this->em->flush();

        return $nomenclature;
    }

    private function updateNomenclature(RequestDto $dto, Nomenclature $nomenclature): Nomenclature
    {

        $this->updateCategory($nomenclature, $dto);
        $this->updateName($nomenclature, $dto);

        if (null !== $dto->getQrCode()) {
            $nomenclature->setQrCode($dto->getQrCode());
        }
        if ($dto->getBarcode()) {
            $nomenclature->setBarcode($dto->getBarcode());
        }
        if ($dto->getMxik()) {
            $nomenclature->setMxik($dto->getMxik());
        }
        if ($dto->getBrand()) {
            $nomenclature->setBrand($dto->getBrand());
        }
        if (null !== $dto->getOldPrice()) {
            $nomenclature->setOldPrice($dto->getOldPrice());
        }
        if (null !== $dto->getPrice()) {
            $nomenclature->setPrice($dto->getPrice());
        }
        if (null !== $dto->getOldPriceCourse()) {
            $nomenclature->setOldPriceCourse($dto->getOldPriceCourse());
        }
        if (null !== $dto->getPriceCourse()) {
            $nomenclature->setPriceCourse($dto->getPriceCourse());
        }
        if (null !== $dto->getNds()) {
            $nomenclature->setNds($dto->getNds());
        }
        if (null !== $dto->getDiscount()) {
            $nomenclature->setDiscount($dto->getDiscount());
        }

        return $nomenclature;
    }

    private function updateName(Nomenclature $nomenclature, RequestDto $dto): void
    {
        if ($dto->getNameUz() || $dto->getNameUzc() || $dto->getNameRu()) {
            $nomenclatureName = $nomenclature->getName();
            $name = [
                'ru' => $dto->getNameRu() ?? $nomenclatureName['ru'],
                'uz' => $dto->getNameUz() ?? $nomenclatureName['uz'],
                'uzc' => $dto->getNameUzc() ?? $nomenclatureName['uzc'],
            ];

            $name = json_decode(json_encode($name, JSON_UNESCAPED_UNICODE), true);
            $nomenclature->setName($name);
        }
    }

    private function updateCategory(Nomenclature $nomenclature, RequestDto $dto): void
    {
        if ($dto->getCategoryId()) {
            $category = $this->em->find(Category::class, $dto->getCategoryId());

            if (null === $category) {
                throw new EntityNotFoundException('category not found');
            }

            $nomenclature->setCategory($category);
        }
    }
}
