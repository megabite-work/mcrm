<?php

namespace App\Action\WebNomenclature;

use App\Action\WebCredential\ArticleAction;
use App\Dto\WebNomenclature\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\Nomenclature;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ArticleAction $articleAction
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $nomenclature = $this->em
            ->getRepository(Nomenclature::class)
            ->findNomenclatureByIdWithMultiStore($dto->nomenclatureId);

        if (! $dto->article) {
            $article = $this->articleAction->__invoke($nomenclature->getMultiStore()->getId())['article'];
        }

        $entity = (new WebNomenclature())
            ->setNomenclature($nomenclature)
            ->setTitle($dto->title)
            ->setArticle($dto->article ?? $article)
            ->setImages($dto->images)
            ->setDescription($dto->description)
            ->setDocument($dto->document);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntityForNomenclature($entity);
    }
}
