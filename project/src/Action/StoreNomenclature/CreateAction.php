<?php

namespace App\Action\StoreNomenclature;

use App\Entity\Store;
use App\Entity\Nomenclature;
use App\Entity\StoreNomenclature;
use Doctrine\ORM\EntityManagerInterface;
use App\Dto\StoreNomenclature\RequestDto;
use App\Component\EntityNotFoundException;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $storeId, RequestDto $dto): Nomenclature
    {
        $store = $this->em->find(Store::class, $storeId);
        $nomenclature = $this->em->find(Nomenclature::class, $dto->getNomenclatureId());

        if (null === $store && null === $nomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $storeNomenclature = (new StoreNomenclature())
            ->setStore($store)
            ->setNomenclature($nomenclature)
            ->setQty($dto->getQty());

        $this->em->persist($storeNomenclature);
        $this->em->flush();

        return $nomenclature;
    }
}
