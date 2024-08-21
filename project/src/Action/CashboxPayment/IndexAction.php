<?php

namespace App\Action\CashboxPayment;

use App\Component\EntityNotFoundException;
use App\Component\Paginator;
use App\Dto\CashboxPayment\RequestQueryDto;
use App\Repository\CashboxPaymentRepository;

class IndexAction
{
    public function __construct(
        private CashboxPaymentRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return match (true) {
            $dto->getCashboxDetailId() && $dto->getPaymentTypeId() => $this->repo->findAllCashboxPaymentsWithJoined($dto),
            $dto->getCashboxId() && $dto->getPaymentTypeId() => $this->repo->findAllCashboxPaymentsByPaymentType($dto),
            is_int($dto->getCashboxDetailId()) => $this->repo->findAllCashboxPaymentsByCashboxDetail($dto),
            default => throw new EntityNotFoundException('not found')
        };
    }
}
