<?php

namespace App\Action\WebFooterBody;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebFooterBody\IndexDto;
use App\Dto\WebFooterBody\RequestQueryDto;
use App\Repository\WebFooterBodyRepository;

class IndexAction
{
    public function __construct(
        private WebFooterBodyRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebFooterBodyByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
