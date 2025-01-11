<?php

namespace App\Action\WebNomenclature;

use App\Dto\WebNomenclature\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\Nomenclature;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $nomenclature = $this->em->getReference(Nomenclature::class, $dto->nomenclatureId);
        $entity = (new WebNomenclature())
            ->setNomenclature($nomenclature)
            ->setTitle($dto->title)
            ->setArticle($dto->article)
            ->setImages($dto->images)
            ->setDescription($dto->description)
            ->setDocument($dto->document);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntityForNomenclature($entity);
    }
}
