<?php

namespace App\Action\WebCredential;

use App\Dto\WebCredential\IndexDto;
use App\Dto\WebCredential\RequestDto;
use App\Entity\WebCredential;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $multiStoreRepository
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $multiStore = $this->multiStoreRepository->findMultiStoreByIdWithWebCredential($dto->multiStoreId);
        $entity = $multiStore->getWebCredential();
        if (! $entity) {
            $entity = (new WebCredential())
                ->setMultiStore($multiStore);
            $this->em->persist($entity);
            $this->em->flush();
        }

        return IndexDto::fromEntity($entity);
    }
}
