<?php

namespace App\Action\Unit;

use App\Dto\Unit\RequestDto;
use App\Entity\Unit;
use App\Repository\UnitRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UnitRepository $unitRepository
    ) {}

    public function __invoke(RequestDto $dto): Unit
    {
        $unit = $this->unitRepository->findOneBy(['code' => $dto->getCode()]);

        if (!$unit) {
            $unit = (new Unit())
                ->setName($dto->getName())
                ->setCode($dto->getCode())
                ->setIcon($dto->getIcon());

            $this->em->persist($unit);
            $this->em->flush();
        }

        return $unit;
    }
}
