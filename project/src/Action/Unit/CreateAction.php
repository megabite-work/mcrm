<?php

namespace App\Action\Unit;

use App\Component\EntityNotFoundException;
<<<<<<< HEAD
use App\Dto\Unit\IndexDto;
=======
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
use App\Dto\Unit\RequestDto;
use App\Entity\Unit;
use App\Repository\UnitRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UnitRepository $unitRepository
    ) {
    }

    public function __invoke(array $dtos): array
    {
<<<<<<< HEAD
        try {
            $this->em->beginTransaction();
            $data = array_map(fn(RequestDto $dto): IndexDto => $this->create($dto), $dtos);
=======
        $this->em->beginTransaction();
        $entities = [];

        try {
            foreach ($dtos as $dto) {
                $entity = $this->create($dto);
                $entities[] = $entity;
            }

>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new EntityNotFoundException($th->getMessage(), $th->getCode());
        }

<<<<<<< HEAD
        return $data;
    }

    private function create(RequestDto $dto): IndexDto
    {
        $entity = $this->unitRepository->findOneBy(['code' => $dto->code]);

        if (!$entity) {
            $entity = (new Unit())
                ->setName($dto->getName())
                ->setCode($dto->code)
                ->setIcon($dto->icon);
            $this->em->persist($entity);
        }

        return IndexDto::fromEntity($entity);
=======
        return $entities;
    }

    private function create(RequestDto $dto): Unit
    {
        $unit = $this->unitRepository->findOneBy(['code' => $dto->getCode()]);

        if (!$unit) {
            $unit = (new Unit())
                ->setName($dto->getName())
                ->setCode($dto->getCode())
                ->setIcon($dto->getIcon());

            $this->em->persist($unit);
        }

        return $unit;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    }
}
