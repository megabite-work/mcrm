<?php

namespace App\Action\MultiStore;

use App\Component\EntityNotFoundException;
use App\Dto\MultiStore\CreateRequestDto;
use App\Entity\MultiStore;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $repo
    ) {
    }

    public function __invoke(int $id, CreateRequestDto $dto): MultiStore
    {
        $multiStore = $this->repo->find($id);

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

        $this->em->flush();

        return $multiStore;
    }
}
