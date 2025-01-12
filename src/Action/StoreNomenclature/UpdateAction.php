<?php

namespace App\Action\StoreNomenclature;

use App\Dto\StoreNomenclature\IndexDto;
use App\Dto\StoreNomenclature\RequestDto;
use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Repository\StoreNomenclatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private StoreNomenclatureRepository $repo
    ) {}

    public function __invoke(int $storeId, int $nomenclatureId, RequestDto $dto): IndexDto
    {
        $store = $this->em->getReference(Store::class, $storeId);
        $nomenclature = $this->em->find(Nomenclature::class, $nomenclatureId);
        $entity = $this->repo->findOneBy(['store' => $store, 'nomenclature' => $nomenclature]);
        $entity->setQty($dto->qty);
        $this->em->flush();

        return IndexDto::fromStore($nomenclature);
    }
}
