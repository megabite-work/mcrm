<?php

namespace App\Action\WebFooter;

use App\Dto\WebFooter\IndexDto;
use App\Dto\WebFooter\RequestDto;
use App\Entity\WebFooter;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebFooter::class, $id);
        $entity->setType($dto->type)
            ->setTitle($dto->title)
            ->setOrder($dto->order)
            ->setIsActive($dto->isActive);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
