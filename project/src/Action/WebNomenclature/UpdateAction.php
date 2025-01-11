<?php

namespace App\Action\WebNomenclature;

use App\Dto\WebNomenclature\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebNomenclature::class, $id);
        $entity->setTitle($dto->title ?? $entity->getTitle())
            ->setArticle($dto->article ?? $entity->getArticle())
            ->setImages($dto->images ?? $entity->getImages())
            ->setDescription($dto->description ?? $entity->getDescription())
            ->setDocument($dto->document ?? $entity->getDocument())
            ->setIsActive($dto->isActive ?? $entity->getIsActive())
            ->setShowComment($dto->showComment ?? $entity->getShowComment());
        $this->em->flush();

        return IndexDto::fromEntityForNomenclature($entity);
    }
}
