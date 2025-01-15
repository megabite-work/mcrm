<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebFooter\RequestQueryDto;
use App\Entity\WebFooter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebFooter>
 */
class WebFooterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebFooter::class);
    }

    public function findAllWebFootersByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wf, wfl
            FROM App\Entity\WebFooter wf
            LEFT JOIN App\Entity\WebFooterLink wfl WITH wfl.webFooterId = wf.id
            WHERE wf.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->multiStoreId]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findWebFooterWithRelation(int $id): mixed
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wf, wfl
            FROM App\Entity\WebFooter wf
            LEFT JOIN App\Entity\WebFooterLink wfl WITH wfl.webFooterId = wf.id
            WHERE wf.id = :id'
        )->setParameters(['id' => $id]);

        return $query->getResult();
    }
}
