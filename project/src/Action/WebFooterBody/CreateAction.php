<?php

namespace App\Action\WebFooterBody;

use App\Dto\WebFooterBody\IndexDto;
use App\Dto\WebFooterBody\RequestDto;
use App\Entity\WebFooterBody;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new WebFooterBody())
            ->setWebFooterId($dto->webFooterId)
            ->setLogo($dto->logo)
            ->setAbout($dto->about)
            ->setIsActive($dto->isActive);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
