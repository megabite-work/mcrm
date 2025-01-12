<?php

namespace App\Action\PaymentType;

use App\Dto\PaymentType\IndexDto;
use App\Repository\PaymentTypeRepository;

class ShowAction
{
    public function __construct(
        private PaymentTypeRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
