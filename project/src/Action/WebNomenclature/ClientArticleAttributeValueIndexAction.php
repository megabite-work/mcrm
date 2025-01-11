<?php

namespace App\Action\WebNomenclature;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\ClientArticleAttributeValue\IndexDto;
use App\Entity\WebNomenclature;
use App\Repository\ClientArticleAttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeValueIndexAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeValueRepository $repo
    ) {}

    public function __invoke(int $id): ListResponseDtoInterface
    {
        $webNomenclature = $this->em->getReference(WebNomenclature::class, $id);
        $entities = $this->repo->findAllByWebNomenclatureWithAttribute($webNomenclature);
        $data = array_map(fn($entity) => IndexDto::fromEntity($entity), $entities);

        return new ListResponseDto($data);
    }
}
