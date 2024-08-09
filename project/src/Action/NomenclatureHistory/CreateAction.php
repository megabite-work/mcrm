<?php

namespace App\Action\NomenclatureHistory;

use App\Entity\User;
use App\Entity\Store;
use App\Entity\ForgiveType;
use App\Entity\Nomenclature;
use App\Entity\NomenclatureHistory;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Dto\NomenclatureHistory\RequestDto;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(RequestDto $dto, User $user): NomenclatureHistory
    {
        $store = $this->em->find(Store::class, $dto->getStoreId());
        $nomenclature = $this->em->find(Nomenclature::class, $dto->getNomenclatureId());

        if (null === $store || null === $nomenclature) {
            throw new EntityNotFoundException('store or nomenclature not found');
        }

        $nomenclatureHistory = (new NomenclatureHistory())
            ->setOwner($user)
            ->setNomenclature($nomenclature)
            ->setStore($store)
            ->setQty($dto->getQty())
            ->setOldPrice($dto->getOldPrice() ?? 0)
            ->setPrice($dto->getPrice() ?? 0)
            ->setOldPriceCourse($dto->getOldPriceCourse() ?? 0)
            ->setPriceCourse($dto->getPriceCourse() ?? 0)
            ->setComment($dto->getComment());

        if ($dto->getForgiveTypeId()) {
            $forgiveType = $this->em->find(ForgiveType::class, $dto->getForgiveTypeId());
            $nomenclatureHistory->setForgiveType($forgiveType);
        }

        $this->em->persist($nomenclatureHistory);
        $this->em->flush();

        return $nomenclatureHistory;
    }
}
