<?php

namespace App\Action\WebView;

use App\Dto\WebView\IndexDto;
use App\Repository\WebViewRepository;

class ShowAction
{
    public function __construct(
        private WebViewRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
