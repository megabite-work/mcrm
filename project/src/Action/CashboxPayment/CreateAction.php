<?php

namespace App\Action\CashboxPayment;

use App\Component\EntityNotFoundException;
use App\Dto\CashboxPayment\RequestDto;
use App\Entity\CashboxDetail;
use App\Entity\CashboxPayment;
use App\Entity\PaymentType;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): CashboxPayment
    {
        $entity = $this->create($dto);

        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): CashboxPayment
    {
        $cashboxDetail = $this->em->find(CashboxDetail::class, $dto->getCashboxDetailId());
        $paymentType = $this->em->find(PaymentType::class, $dto->getPaymentTypeId());

        if (!$cashboxDetail || !$paymentType) {
            throw new EntityNotFoundException("cashboxDetail or paymentType not found");
        }

        $entity = (new CashboxPayment())
            ->setCashboxDetail($cashboxDetail)
            ->setPaymentType($paymentType)
            ->setAmount($dto->getAmount());

        $this->em->persist($entity);

        return $entity;
    }
}
