<?php

namespace App\Action\Nomenclature;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Nomenclature\IndexDto;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Entity\Category;
use App\Repository\NomenclatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class IndexAction
{
    public function __construct(
        private NomenclatureRepository $repo,
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllNomenclatures($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromShowAction($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
