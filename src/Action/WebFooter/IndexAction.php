<?php

namespace App\Action\WebFooter;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebFooterLink\IndexDto as WebFooterLinkIndexDto;
use App\Dto\WebFooter\IndexDto;
use App\Dto\WebFooter\RequestQueryDto;
use App\Entity\WebFooter;
use App\Entity\WebFooterLink;
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
        $footers = [];
        $links = [];
        foreach ($data as $item) {
            if ($item instanceof WebFooter) {
                $footers[$item->getId()] = $item;
            } elseif ($item instanceof WebFooterLink) {
                $links[$item->getWebFooterId()][] = WebFooterLinkIndexDto::fromEntity($item);
            }
        }
        
        $res = array_map(function ($footer) use ($links) {
            return isset($links[$footer->getId()])
                ? IndexDto::fromEntityWithRelation($footer, $links[$footer->getId()])
                : IndexDto::fromEntityWithRelation($footer);
        }, $footers);

        return new ListResponseDto($res, $paginator->getPagination());
    }
}
