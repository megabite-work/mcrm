<?php

namespace App\Action\CashboxDetail;

use App\Component\CurrentUser;
use App\Component\EntityNotFoundException;
use App\Dto\CashboxDetail\RequestDto;
use App\Entity\CashboxDetail;
use App\Entity\Cashbox;
use App\Entity\CounterPart;
use App\Repository\CashboxDetailRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxDetailRepository $repo,
        private CurrentUser $user
    ) {}

    public function __invoke(RequestDto $dto): CashboxDetail
    {
        $cashbox = $this->em->find(Cashbox::class, $dto->getCashboxId());

        if (null === $cashbox) {
            throw new EntityNotFoundException('not found');
        }

        $chequeNumber = $this->repo->getLastChequeNumberByCashbox($cashbox);
        $dto->setChequeNumber($chequeNumber);
        $entity = $this->create($cashbox, $dto);

        $this->em->flush();

        return $entity;
    }

    private function create(Cashbox $cashbox, RequestDto $dto): CashboxDetail
    {
        $entity = (new CashboxDetail())
            ->setChequeNumber($dto->getChequeNumber())
            ->setType($dto->getType())
            ->setReturnStatus($dto->getReturnStatus())
            ->setCreditStatus($dto->getCreditStatus())
            ->setCreditType($dto->getCreditType())
            ->setSale($dto->getSale())
            ->setDiscount($dto->getDiscount())
            ->setAdvance($dto->getAdvance())
            ->setRemain($dto->getRemain())
            ->setNds($dto->getNds())
            ->setSurrender($dto->getSurrender())
            ->setCredit($dto->getCredit())
            ->setCounterPart($this->getCounterPartOrNull($dto))
            ->setUser($this->user->getUser())
            ->setCashbox($cashbox);
        
        $entity = $this->setDetail($entity, $dto);

        $this->em->persist($entity);

        return $entity;
    }

    private function getCounterPartOrNull(RequestDto $dto): ?CounterPart
    {
        if ($dto->getCounterPartId()) {
            return $this->em->find(CounterPart::class, $dto->getCounterPartId());
        }

        return null;
    }

    private function setDetail(CashboxDetail $entity, RequestDto $dto): CashboxDetail
    {
        if ($dto->getDetailId()) {
            $detail = $this->repo->findCashboxDetailById($dto->getDetailId());
            $entity->setDetail($detail);
        }

        return $entity;
    }
}
