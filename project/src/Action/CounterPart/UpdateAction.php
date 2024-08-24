<?php

namespace App\Action\CounterPart;

use App\Component\EntityNotFoundException;
use App\Dto\CounterPart\RequestDto;
use App\Entity\CounterPart;
use App\Repository\CounterPartRepository;
use App\Repository\PhoneRepository;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CounterPartRepository $repo,
        private PhoneRepository $phoneRepository,
        private AddressRepository $addressRepository,
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): CounterPart
    {
        $counterPart = $this->repo->find($id);

        if (null === $counterPart) {
            throw new EntityNotFoundException('not found');
        }

        $counterPart = $this->updateCounterPart($counterPart, $dto);

        $this->phoneRepository->checkPhoneExistsAndCreate($counterPart, $dto->getPhones());
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($counterPart, $dto);

        $this->em->flush();

        return $counterPart;
    }

    private function updateCounterPart(CounterPart $counterPart, RequestDto $dto)
    {
        if ($dto->getName()) {
            $counterPart->setName($dto->getName());
        }
        if ($dto->getInn()) {
            $counterPart->setInn($dto->getInn());
        }
        if ($dto->getDiscount()) {
            $counterPart->setDiscount($dto->getDiscount());
        }

        return $counterPart;
    }
}
