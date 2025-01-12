<?php

namespace App\Action\NomenclatureHistory;

use App\Action\StoreNomenclature\CreateOrUpdateAction;
use App\Dto\NomenclatureHistory\IndexDto;
use App\Dto\NomenclatureHistory\RequestDto;
use App\Entity\ForgiveType;
use App\Entity\Nomenclature;
use App\Entity\NomenclatureHistory;
use App\Entity\Store;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CreateOrUpdateAction $createOrUpdateAction
    ) {}

    public function __invoke(RequestDto $dto, User $user): IndexDto
    {
        $store = $this->em->getReference(Store::class, $dto->storeId);
        $nomenclature = $this->em->getReference(Nomenclature::class, $dto->nomenclatureId);
        $entity = $this->create($user, $nomenclature, $store, $dto);
        $this->createOrUpdateAction->__invoke($store, $nomenclature, $dto->qty);
        $this->em->flush();

        return IndexDto::fromCreateAction($entity);
    }

    private function create(User $user, Nomenclature $nomenclature, Store $store, RequestDto $dto): NomenclatureHistory
    {
        $entity = (new NomenclatureHistory())
            ->setOwner($user)
            ->setNomenclature($nomenclature)
            ->setStore($store)
            ->setQty($dto->qty)
            ->setOldPrice($dto->oldPrice ?? 0)
            ->setPrice($dto->price ?? 0)
            ->setOldPriceCourse($dto->oldPriceCourse ?? 0)
            ->setPriceCourse($dto->priceCourse ?? 0)
            ->setComment($dto->comment);

        if ($dto->forgiveTypeId) {
            $forgiveType = $this->em->getReference(ForgiveType::class, $dto->forgiveTypeId);
            $entity->setForgiveType($forgiveType);
        }

        $this->em->persist($entity);

        return $entity;
    }
}
