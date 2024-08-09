<?php

namespace App\Action\WebNomenclature;

use App\Entity\Nomenclature;
use App\Entity\WebNomenclature;
use App\Dto\WebNomenclature\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): WebNomenclature
    {
        $nomenclature = $this->em->find(Nomenclature::class, $dto->getNomenclatureId());

        if (null === $nomenclature) {
            throw new EntityNotFoundException('nomenclature not found');
        }

        $webNomenclature = (new WebNomenclature())
            ->setTitle($dto->getTitle())
            ->setNomenclature($nomenclature)
            ->setArticle($dto->getArticle())
            ->setImage($dto->getImage())
            ->setDescription($dto->getDescription())
            ->setDocument($dto->getDocument());

        $this->em->persist($webNomenclature);
        $this->em->flush();

        return $webNomenclature;
    }
}
