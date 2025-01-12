<?php

namespace App\Action\WebFooter;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebFooter\IndexDto;
use App\Dto\WebFooter\RequestQueryDto;
use App\Repository\WebFooterRepository;

class IndexAction
{
    public function __construct(
        private WebFooterRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebFootersByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
