<?php

namespace App\Action\Cashbox;

use App\Entity\Cashbox;
use App\Dto\Cashbox\RequestDto;
use App\Repository\CashboxRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxRepository $repo
    ) {}

    public function __invoke(int $id, RequestDto $dto): Cashbox
    {
        $cashbox = $this->repo->findCashboxByIdWithStore($id);

        if (null === $cashbox) {
            throw new EntityNotFoundException('not found');
        }

        $cashbox = $this->updateCashbox($cashbox, $dto);

        $this->em->flush();

        return $cashbox;
    }

    private function updateCashbox(Cashbox $cashbox, RequestDto $dto)
    {
        if ($dto->getName() && $this->repo->hasCashboxByNameAndStore($cashbox->getStore(), $dto->getName())) {
            $cashbox->setName($dto->getName());
        }
        if (null !== $dto->getIsActive()) {
            $cashbox->setIsActive($dto->getIsActive());
        }
        if ($dto->getChequeNumber()) {
            $cashbox->setChequeNumber($dto->getChequeNumber());
        }
        if ($dto->getTerminalId()) {
            $cashbox->setTerminalId($dto->getTerminalId());
        }
        if ($dto->getShiftNumber()) {
            $cashbox->setShiftNumber($dto->getShiftNumber());
        }
        if ($dto->getZNumber()) {
            $cashbox->setZNumber($dto->getZNumber());
        }
        if ($dto->getXNumber()) {
            $cashbox->setXNumber($dto->getXNumber());
        }
        if ($dto->getWorkplace()) {
            $cashbox->setWorkplace($dto->getWorkplace());
        }
        if ($dto->getHumoArcusFolder()) {
            $cashbox->setHumoArcusFolder($dto->getHumoArcusFolder());
        }

        return $cashbox;
    }
}
