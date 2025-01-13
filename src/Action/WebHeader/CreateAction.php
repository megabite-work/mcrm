<?php

namespace App\Action\WebHeader;

use App\Dto\WebHeader\IndexDto;
use App\Dto\WebHeader\RequestDto;
use App\Entity\WebHeader;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new WebHeader())
            ->setMultiStoreId($dto->multiStoreId)
            ->setType($dto->type)
            ->setIsActive($dto->isActive);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
