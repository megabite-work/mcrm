<?php

namespace App\Action\WebFooterBody;

use App\Dto\WebFooterBody\IndexDto;
use App\Dto\WebFooterBody\RequestDto;
use App\Entity\WebFooterBody;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebFooterBody::class, $id);
        $entity->setWebFooterId($dto->webFooterId ?? $entity->getWebFooterId())
            ->setLogo($dto->logo ?? $entity->getLogo())
            ->setAbout($dto->about ?? $entity->getAbout())
            ->setIsActive($dto->isActive);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
