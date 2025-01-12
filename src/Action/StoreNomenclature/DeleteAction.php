<?php

namespace App\Action\StoreNomenclature;

use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $storeId, int $nomenclatureId): void
    {
        $store = $this->em->getReference(Store::class, $storeId);
        $nomenclature = $this->em->getReference(Nomenclature::class, $nomenclatureId);
        $entity = $this->em->getRepository(StoreNomenclature::class)->findOneBy(['store' => $store, 'nomenclature' => $nomenclature]);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
