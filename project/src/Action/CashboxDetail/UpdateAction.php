<?php

namespace App\Action\CashboxDetail;

use App\Component\EntityNotFoundException;
use App\Dto\CashboxDetail\RequestDto;
use App\Entity\CashboxDetail;
use App\Repository\CashboxDetailRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxDetailRepository $repo
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): CashboxDetail
    {
        $entity = $this->repo->findCashboxDetailById($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->updateCashboxDetail($entity, $dto);

        $this->em->flush();

        return $entity;
    }

    private function updateCashboxDetail(CashboxDetail $entity, RequestDto $dto)
    {
        if (null !== $dto->getReturnStatus()) {
            $entity->setReturnStatus($dto->getReturnStatus());
        }
        if (null !== $dto->getCreditStatus()) {
            $entity->setCreditStatus($dto->getCreditStatus());
        }
        if ($dto->getSurrender()) {
            $entity->setSurrender($dto->getSurrender());
        }
        if ($dto->getSale()) {
            $entity->setSale($dto->getSale());
        }
        if ($dto->getDiscount()) {
            $entity->setDiscount($dto->getDiscount());
        }
        if ($dto->getNds()) {
            $entity->setNds($dto->getNds());
        }
        if ($dto->getAdvance()) {
            $entity->setAdvance($dto->getAdvance());
        }
        if ($dto->getCredit()) {
            $entity->setCredit($dto->getCredit());
        }
        if ($dto->getRemain()) {
            $entity->setRemain($dto->getRemain());
        }
        if ($dto->getRemain()) {
            $entity->setRemain($dto->getRemain());
        }

        return $entity;
    }
}
