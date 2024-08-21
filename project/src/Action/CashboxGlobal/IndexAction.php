<?php

namespace App\Action\CashboxGlobal;

use App\Component\Paginator;
use App\Dto\CashboxGlobal\RequestQueryDto;
use App\Repository\CashboxGlobalRepository;

class IndexAction
{
    public function __construct(
        private CashboxGlobalRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllCashboxGlobalsByCashboxDetail($dto);
    }
}
