<?php

namespace App\Action\Cashbox;

use App\Component\EntityNotFoundException;
use App\Dto\Cashbox\RequestDto;
use App\Entity\Store;
use App\Entity\Cashbox;
use App\Repository\CashboxRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): Cashbox
    {
        $store = $this->em->find(Store::class, $dto->getStoreId());

        if (!$this->repo->hasCashboxByNameAndStore($store, $dto->getName())) {
            throw new EntityNotFoundException('this name already exists', 400);
        }

        $cashbox = $this->create($store, $dto);

        $this->em->flush();

        return $cashbox;
    }

    private function create(Store $store, RequestDto $dto): Cashbox
    {
        $cashbox = (new Cashbox())
            ->setName($dto->getName())
            ->setStore($store);

        $this->em->persist($cashbox);

        return $cashbox;
    }
}
