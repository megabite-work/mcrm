<?php

namespace App\Action\Nomenclature;

use App\Dto\Nomenclature\IndexDto;
use App\Dto\Nomenclature\RequestDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\Nomenclature;
use App\Entity\Unit;
use App\Exception\ErrorException;
use App\Repository\NomenclatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private NomenclatureRepository $repo
    ) {}

    public function __invoke(array $dtos): array
    {
        try {
            $this->em->beginTransaction();
            $entities = array_map(fn($dto): IndexDto => $this->create($dto), $dtos);
            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new ErrorException('Nomenclature', $th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function create(RequestDto $dto): IndexDto
    {
        $category = $this->em->getReference(Category::class, $dto->categoryId);
        $multiStore = $this->em->find(MultiStore::class, $dto->multiStoreId);
        $unit = $this->em->getRepository(Unit::class)->findOneBy(['code' => $dto->unitCode]);

        $entity = (new Nomenclature())
            ->setMxik($dto->mxik)
            ->setBrand($dto->brand)
            ->setOldPrice($dto->oldPrice ?? 0)
            ->setPrice($dto->price ?? 0)
            ->setOldPriceCourse($dto->oldPriceCourse ?? 0)
            ->setPriceCourse($dto->priceCourse ?? 0)
            ->setNds($dto->nds ?? 0)
            ->setDiscount($dto->discount ?? 0)
            ->setMultiStore($multiStore)
            ->setUnit($unit)
            ->setCategory($category);
        $this->barcode($multiStore, $entity, $dto->barcode);
        $this->name($entity, $dto);
        $this->em->persist($entity);

        return IndexDto::fromEntity($entity);
    }

    private function barcode(MultiStore $multiStore, Nomenclature $nomenclature, ?int $barcode): void
    {
        if (null === $barcode || $this->repo->findOneBy(['barcode' => $barcode, 'multiStore' => $multiStore])) {
            $barcode = $multiStore->getBarcodeTtn() + 1;
            $multiStore->setBarcodeTtn($barcode);
        }

        $nomenclature->setBarcode($barcode);
    }

    private function name(Nomenclature $nomenclature, RequestDto $dto): void
    {
        if (! $this->repo->IsUniqueNameByMultiStore($dto)) {
            throw new ErrorException('Nomenclature', 'Name is not unique');
        }

        $nomenclature->setName($dto->getName());
    }
}
