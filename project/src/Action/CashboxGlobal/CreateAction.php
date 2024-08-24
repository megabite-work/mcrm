<?php

namespace App\Action\CashboxGlobal;

use App\Component\EntityNotFoundException;
use App\Dto\CashboxGlobal\RequestDto;
use App\Entity\CashboxDetail;
use App\Entity\CashboxGlobal;
use App\Entity\Nomenclature;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): array
    {
        $entities = $this->create($dto);

        $this->em->flush();

        return $entities;
    }

    private function create(RequestDto $dto): array
    {
        $cashboxDetail = $this->em->find(CashboxDetail::class, $dto->getCashboxDetailId());

        if (!$cashboxDetail) {
            throw new EntityNotFoundException('cashboxDetail not found');
        }

        $entities = [];
        foreach ($dto->getItems() as $item) {
            $entity = (new CashboxGlobal())
                ->setCashboxDetail($cashboxDetail)
                ->setNomenclature($this->getNomenclature($item->getNomenclatureId()))
                ->setQty($item->getQty())
                ->setOldPrice($item->getOldPrice())
                ->setPrice($item->getPrice())
                ->setOldPriceCourse($item->getOldPriceCourse())
                ->setPriceCourse($item->getPriceCourse())
                ->setNds($item->getNds())
                ->setNdsSum($item->getNdsSum())
                ->setDiscount($item->getDiscount())
                ->setDiscountSum($item->getDiscountSum());

            $this->em->persist($entity);
            $entities[] = $entity;
        }

        return $entities;
    }

    private function getNomenclature(int $id): Nomenclature
    {
        $nomenclature = $this->em->find(Nomenclature::class, $id);

        if (!$nomenclature) {
            throw new EntityNotFoundException('cashboxDetail not found');
        }

        return $nomenclature;
    }
}
