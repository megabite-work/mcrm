<?php

namespace App\Action\WebView;

use App\Dto\WebView\IndexDto;
use App\Dto\WebView\RequestDto;
use App\Entity\WebView;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebView::class, $id);
        $entity->setType($dto->type)
            ->setIsActive($dto->isActive);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
