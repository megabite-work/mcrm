<?php

namespace App\Action\StoreNomenclature;

use App\Dto\StoreNomenclature\IndexDto;
use App\Dto\StoreNomenclature\RequestDto;
use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use App\Exception\ErrorException;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $storeId, array $dtos): array
    {
        try {
            $this->em->beginTransaction();
            $data = array_map(fn($dto): IndexDto => $this->create($storeId, $dto), $dtos);
            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new ErrorException('StoreNomenclature', $th->getMessage());
        }

        return $data;
    }

    private function create(int $storeId, RequestDto $dto): IndexDto
    {
        $store = $this->em->getReference(Store::class, $storeId);
        $nomenclature = $this->em->find(Nomenclature::class, $dto->nomenclatureId);
        $entity = (new StoreNomenclature())
            ->setStore($store)
            ->setNomenclature($nomenclature)
            ->setQty($dto->qty);
        $this->em->persist($entity);

        return IndexDto::fromStore($entity);
    }
}
