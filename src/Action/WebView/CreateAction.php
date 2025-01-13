<?php

namespace App\Action\WebView;

use App\Dto\WebView\IndexDto;
use App\Dto\WebView\RequestDto;
use App\Entity\WebView;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new WebView())
            ->setMultiStoreId($dto->multiStoreId)
            ->setType($dto->type)
            ->setIsActive($dto->isActive);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
