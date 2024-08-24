<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\RequestDto;
use App\Entity\WebBanner;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(int $id, RequestDto $dto): WebBanner
    {
        $entity = $this->em->find(WebBanner::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->update($entity, $dto);

        $this->em->flush();

        return $entity;
    }

    private function update(WebBanner $entity, RequestDto $dto)
    {
        if (null !== $dto->getIsActive()) {
            $entity->setIsActive($dto->getIsActive());
        }
        if ($dto->getType()) {
            $entity->setType($dto->getType());
        }
        if ($dto->getTypeId()) {
            $entity->setTypeId($dto->getTypeId());
        }
        if ($dto->getImage()) {
            $entity->setImage($dto->getImage());
        }

        return $entity;
    }
}
