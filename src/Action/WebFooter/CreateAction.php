<?php

namespace App\Action\WebFooter;

use App\Dto\WebFooter\IndexDto;
use App\Dto\WebFooter\RequestDto;
use App\Entity\WebFooter;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new WebFooter())
            ->setMultiStoreId($dto->multiStoreId)
            ->setType($dto->type)
            ->setTitle($dto->title)
            ->setOrder($dto->order)
            ->setLinks($dto->links)
            ->setIsActive($dto->isActive);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
