<?php

namespace App\Action\Unit;

use App\Dto\Unit\IndexDto;
use App\Dto\Unit\RequestDto;
use App\Entity\Unit;
use App\Exception\ErrorException;
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
        try {
            $this->em->beginTransaction();
            $data = array_map(fn(RequestDto $dto): IndexDto => $this->create($dto), $dtos);
            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new ErrorException('Unit', $th->getMessage());
        }

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
    }
}
