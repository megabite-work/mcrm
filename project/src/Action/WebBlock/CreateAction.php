<?php

namespace App\Action\WebBlock;

use App\Component\EntityNotFoundException;
use App\Dto\WebBlock\RequestDto;
use App\Entity\MultiStore;
use App\Entity\WebBlock;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(RequestDto $dto): WebBlock
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId())
            ?? throw new EntityNotFoundException('multi store not found', 404);

        $entity = $this->create($dto);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): WebBlock
    {
        $entity = (new WebBlock())
            ->setMultiStoreId($dto->getMultiStoreId())
            ->setType($dto->getType())
            ->setTypeId($dto->getTypeId())
            ->setIsActive($dto->getIsActive())
            ->setOrder($dto->getOrder());

        $this->em->persist($entity);

        return $entity;
    }
}
