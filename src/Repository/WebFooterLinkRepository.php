<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebFooterLink\RequestQueryDto;
use App\Entity\WebFooterLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebFooterLink>
 */
class WebFooterLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebFooterLink::class);
    }

    public function findAllWebFooterLinksByWebFooter(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wfl
            FROM App\Entity\WebFooterLink wfl
            WHERE wfl.webFooterId = :webFooterId'
        )->setParameters(['webFooterId' => $dto->webFooterId]);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
