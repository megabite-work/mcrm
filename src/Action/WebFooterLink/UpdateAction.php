<?php

namespace App\Action\WebFooterLink;

use App\Dto\WebFooterLink\IndexDto;
use App\Dto\WebFooterLink\RequestDto;
use App\Entity\WebFooterLink;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebFooterLink::class, $id);
        $entity->setWebFooterBodyId($dto->webFooterBodyId ?? $entity->getWebFooterBodyId())
            ->setType($dto->type ?? $entity->getType())
            ->setTitle($dto->title ?? $entity->getTitle())
            ->setLink($dto->link ?? $entity->getLink())
            ->setIsActive($dto->isActive ?? $entity->getIsActive());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
