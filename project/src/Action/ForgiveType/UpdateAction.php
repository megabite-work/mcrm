<?php

namespace App\Action\ForgiveType;

use App\Component\EntityNotFoundException;
use App\Dto\ForgiveType\RequestDto;
use App\Entity\ForgiveType;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): ForgiveType
    {
        $forgiveType = $this->updateForgiveType($id, $dto);

        $this->em->flush();

        return $forgiveType;
    }

    private function updateForgiveType(int $id, RequestDto $dto): ForgiveType
    {
        $forgiveType = $this->em->find(ForgiveType::class, $id);

        if (null === $forgiveType) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getNameUz() || $dto->getNameUzc() || $dto->getNameRu()) {
            $categoryName = $forgiveType->getName();
            $name = [
                'ru' => $dto->getNameRu() ?? $categoryName['ru'],
                'uz' => $dto->getNameUz() ?? $categoryName['uz'],
                'uzc' => $dto->getNameUzc() ?? $categoryName['uzc'],
            ];
            $forgiveType->setName($name);
        }

        return $forgiveType;
    }
}
