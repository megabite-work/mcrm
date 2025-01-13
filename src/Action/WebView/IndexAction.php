<?php

namespace App\Action\WebView;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebView\IndexDto;
use App\Dto\WebView\RequestQueryDto;
use App\Repository\WebViewRepository;

class IndexAction
{
    public function __construct(
        private WebViewRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebViewsByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
