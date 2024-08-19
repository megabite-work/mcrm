<?php

namespace App\Action\CounterPart;

use App\Entity\MultiStore;
use App\Entity\CounterPart;
use App\Dto\CounterPart\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CounterPartRepository;
use App\Component\EntityNotFoundException;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CounterPartRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): CounterPart
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        if (null == $multiStore) {
            throw new EntityNotFoundException('not found');
        }

        $cashbox = $this->create($multiStore, $dto);

        $this->em->flush();

        return $cashbox;
    }

    private function create(MultiStore $multiStore, RequestDto $dto): CounterPart
    {
        $cashbox = (new CounterPart())
            ->setName($dto->getName())
            ->setInn($dto->getInn())
            ->setDiscount($dto->getDiscount())
            ->setMultiStore($multiStore);

        $this->em->persist($cashbox);

        return $cashbox;
    }
}
