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
        foreach ($data as $key => $item) {
            if ($item instanceof WebFooter) {
                $footers[$item->getId()] = $item;
                unset($data[$key]);
            }
        }
        $links = [];
        foreach ($data as $key => $item) {
            if ($item instanceof WebFooterLink) {
                $links[$item->getWebFooterId()][] = WebFooterLinkIndexDto::fromEntity($item);
                unset($data[$key]);
            }
        }
        $res = [];
        foreach ($footers as $key => $footer) {
            $res[] = isset($links[$key])
                ? IndexDto::fromEntityWithRelation($footer, $links[$key])
                : IndexDto::fromEntityWithRelation($footer);
        }

        return new ListResponseDto($res, $paginator->getPagination());
    }
}
