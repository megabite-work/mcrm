<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebView\RequestQueryDto;
use App\Entity\WebView;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebView>
 */
class WebViewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebView::class);
    }

    public function findAllWebViewsByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wv
            FROM App\Entity\WebView wv
            WHERE wv.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->multiStoreId]);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
