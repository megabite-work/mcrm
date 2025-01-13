<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebHeader\RequestQueryDto;
use App\Entity\WebHeader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebHeader>
 */
class WebHeaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebHeader::class);
    }

    public function findAllWebHeadersByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wh
            FROM App\Entity\WebHeader wh
            WHERE wh.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->multiStoreId]);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
