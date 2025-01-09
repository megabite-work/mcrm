<?php

namespace App\Action\WebBlock;

use App\Component\EntityNotFoundException;
use App\Dto\WebBlock\SortDto;
use App\Entity\WebBlock;
use Doctrine\ORM\EntityManagerInterface;

class SortAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(array $dtos): void
    {
        /** @var SortDto $dto */
        foreach ($dtos as $dto) {
            $entity = $this->em->find(WebBlock::class, $dto->id)
                ?? throw new EntityNotFoundException('not found');

            $entity->setOrder($dto->order);
            $this->em->persist($entity);
        }

        $this->em->flush();
    }
}
