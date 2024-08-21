<?php

namespace App\Action\CashboxGlobal;

use App\Component\EntityNotFoundException;
use App\Dto\CashboxGlobal\UpdateRequestDto;
use App\Entity\CashboxGlobal;
use App\Repository\CashboxGlobalRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxGlobalRepository $repo
    ) {}

    public function __invoke(int $id, UpdateRequestDto $dto): CashboxGlobal
    {
        $entity = $this->repo->findCashboxGlobalById($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->updateCashboxGlobal($entity, $dto);

        $this->em->flush();

        return $entity;
    }

    private function updateCashboxGlobal(CashboxGlobal $entity, UpdateRequestDto $dto)
    {
        if ($dto->getQty()) {
            $entity->setQty($dto->getQty());
        }
        if ($dto->getOldPrice()) {
            $entity->setOldPrice($dto->getOldPrice());
        }
        if ($dto->getPrice()) {
            $entity->setPrice($dto->getPrice());
        }
        if ($dto->getDiscount()) {
            $entity->setDiscount($dto->getDiscount());
        }
        if ($dto->getDiscountSum()) {
            $entity->setDiscountSum($dto->getDiscountSum());
        }
        if ($dto->getNds()) {
            $entity->setNds($dto->getNds());
        }
        if ($dto->getNdsSum()) {
            $entity->setNdsSum($dto->getNdsSum());
        }
        if ($dto->getOldPriceCourse()) {
            $entity->setOldPriceCourse($dto->getOldPriceCourse());
        }
        if ($dto->getPriceCourse()) {
            $entity->setPriceCourse($dto->getPriceCourse());
        }

        return $entity;
    }


}
