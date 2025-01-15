<?php

namespace App\Action\WebFooter;

use App\Dto\WebFooter\SortDto;
use App\Entity\WebFooter;
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
            $entity = $this->em->find(WebFooter::class, $dto->id);
            $entity->setOrder($dto->order);
            $this->em->persist($entity);
        }

        $this->em->flush();
    }
}
