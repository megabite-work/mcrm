<?php

namespace App\Action\MultiStore;

use App\Entity\Phone;
use App\Entity\Address;
use App\Entity\MultiStore;
use App\Dto\MultiStore\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): MultiStore
    {
        $multiStore = $this->updateMultiStore($id, $dto);

        $this->em->getRepository(Phone::class)->checkPhoneExistsAndCreate($multiStore, $dto->getPhones());
        $this->em->getRepository(Address::class)->checkAddressExistsAndUpdateOrCreate($multiStore, $dto);
        $this->em->flush();

        return $multiStore;
    }

    private function updateMultiStore(int $id, RequestDto $dto)
    {
        $multiStore = $this->em->getRepository(MultiStore::class)->findMultiStoreByIdWithAddressAndPhones($id);

        if (null === $multiStore) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getName()) {
            $multiStore->setName($dto->getName());
        }
        if ($dto->getProfit()) {
            $multiStore->setProfit($dto->getProfit());
        }
        if ($dto->getBarcodeTtn()) {
            $multiStore->setBarcodeTtn($dto->getBarcodeTtn());
        }
        if ($dto->getNds()) {
            $multiStore->setNds($dto->getNds());
        }

        return $multiStore;
    }
}
