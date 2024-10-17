<?php

namespace App\Action\Nomenclature;

use App\Component\Paginator;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Repository\NomenclatureRepository;

class IndexAction
{
    public function __construct(
        private NomenclatureRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        // if ($dto->getCategoryId()) {
        //     $nomenclatures = $this->repo->findAllNomenclaturesByCategory($dto);
        // } else {
        //     $nomenclatures = $this->repo->findAllNomenclatures($dto);
        // }


        return $dto->getCategoryId() ? $this->repo->findAllNomenclaturesByCategory($dto) : $this->repo->findAllNomenclatures($dto);
    }
}
