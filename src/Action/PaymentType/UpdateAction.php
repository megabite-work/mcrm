<?php

namespace App\Action\PaymentType;

use App\Dto\PaymentType\IndexDto;
use App\Dto\PaymentType\RequestDto;
use App\Repository\PaymentTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PaymentTypeRepository $repo
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->repo->find($id);
        $entity->setName([
            'en' => $dto->nameEn ?? $entity->getName()['en'],
            'ru' => $dto->nameRu ?? $entity->getName()['ru'],
            'uz' => $dto->nameUz ?? $entity->getName()['uz'],
            'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
        ])
            ->setType($dto->type ?? $entity->getType());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
