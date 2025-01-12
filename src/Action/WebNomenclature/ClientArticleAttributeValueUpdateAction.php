<?php

namespace App\Action\WebNomenclature;

use App\Dto\ClientArticleAttributeValue\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\WebNomenclature;
use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeValueUpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {}

    public function __invoke(int $id, int $valueId, RequestDto $dto): IndexDto
    {
        $webNomenclature = $this->em->getReference(WebNomenclature::class, $id);
        $entity = $this->repo->findOneBy(['id' => $valueId, 'webNomenclature' => $webNomenclature]);
        $entity->setValue([
            'ru' => $dto->valueRu ?? $entity->getValue()['ru'],
            'uz' => $dto->valueUz ?? $entity->getValue()['uz'],
            'uzc' => $dto->valueUzc ?? $entity->getValue()['uzc'],
        ]);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
