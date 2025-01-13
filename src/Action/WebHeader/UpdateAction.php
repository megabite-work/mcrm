<?php

namespace App\Action\WebHeader;

use App\Dto\WebHeader\IndexDto;
use App\Dto\WebHeader\RequestDto;
use App\Entity\WebHeader;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebHeader::class, $id);
        $entity->setType($dto->type)
            ->setOrder($dto->order)
            ->setIsActive($dto->isActive);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
