<?php

namespace App\Action\StoreNomenclature;

use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use App\Repository\StoreNomenclatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateOrUpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private StoreNomenclatureRepository $repo
    ) {
    }

    public function __invoke(Store $store, Nomenclature $nomenclature, float $qty): void
    {
        $storeNomenclature = $this->repo->findStoreNomenclatureByStoreAndNomenclature($store, $nomenclature);

        if (null === $storeNomenclature) {
            $this->create($store, $nomenclature, $qty);
        } else {
            $this->update($storeNomenclature, $qty);
        }
    }

<<<<<<< HEAD
    private function create(Store $store, Nomenclature $nomenclature, float $qty): void
=======
    private function create(Store $store, Nomenclature $nomenclature, float $qty)
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    {
        $storeNomenclature = (new StoreNomenclature())
            ->setStore($store)
            ->setNomenclature($nomenclature)
            ->setQty($qty);

        $this->em->persist($storeNomenclature);
    }

<<<<<<< HEAD
    private function update(StoreNomenclature $storeNomenclature, float $qty): void
=======
    private function update(StoreNomenclature $storeNomenclature, float $qty)
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    {
        $updatedQty = $storeNomenclature->getQty() + $qty;
        $storeNomenclature->setQty($updatedQty);
    }
}
