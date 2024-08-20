<?php

namespace App\Action\CounterPart;

use App\Component\EntityNotFoundException;
use App\Dto\CounterPart\RequestDto;
use App\Entity\CounterPart;
use App\Entity\MultiStore;
use App\Entity\Phone;
use App\Repository\CounterPartRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CounterPartRepository $repo
    ) {
    }

    public function __invoke(RequestDto $dto): CounterPart
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());
        $counterPart = $this->repo->findOneBy(['name' => $dto->getName(), 'inn' => $dto->getInn()]);

        if (null == $multiStore) {
            throw new EntityNotFoundException('not found');
        }
        if (null !== $counterPart) {
            throw new EntityNotFoundException('already exists');
        }

        $cashbox = $this->create($multiStore, $dto);
        $this->em->getRepository(Phone::class)->checkPhoneExistsAndCreate($counterPart, $dto->getPhones());

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
