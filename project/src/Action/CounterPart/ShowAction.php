<?php

namespace App\Action\CounterPart;

use App\Component\EntityNotFoundException;
use App\Entity\CounterPart;
use App\Repository\CounterPartRepository;

class ShowAction
{
    public function __construct(private CounterPartRepository $repo)
    {
    }

    public function __invoke(int $id): CounterPart
    {
        $counterPart = $this->repo->findCounterPartWithAddressAndPhonesById($id);

        if (null === $counterPart) {
            throw new EntityNotFoundException('not found');
        }

        return $counterPart;
    }
}
