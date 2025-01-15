<?php

namespace App\Action\WebFooterLink;

use App\Dto\WebFooterLink\IndexDto;
use App\Dto\WebFooterLink\RequestDto;
use App\Entity\WebFooterLink;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new WebFooterLink())
            ->setWebFooterId($dto->webFooterId)
            ->setType($dto->type)
            ->setTitle($dto->title)
            ->setLink($dto->link)
            ->setIsActive($dto->isActive);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
