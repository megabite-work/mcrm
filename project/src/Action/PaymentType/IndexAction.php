<?php

namespace App\Action\PaymentType;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\PaymentType\IndexDto;
use App\Repository\PaymentTypeRepository;

class IndexAction
{
    public function __construct(
        private PaymentTypeRepository $repo
    ) {}

    public function __invoke(): ListResponseDtoInterface
    {
        $data = array_map(fn($entity) => IndexDto::fromEntity($entity), $this->repo->findAll());

        return new ListResponseDto($data);
    }
}
