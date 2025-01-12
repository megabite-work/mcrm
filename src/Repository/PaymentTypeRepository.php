<?php

namespace App\Repository;

use App\Dto\PaymentType\RequestDto;
use App\Entity\PaymentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaymentType>
 */
class PaymentTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentType::class);
    }

    public function findPaymentTypeOrNull(RequestDto $dto): ?PaymentType
    {
        $qb = $this->createQueryBuilder('p');

        $params = new ArrayCollection([
            new Parameter('nameEn', '%'.$dto->nameEn.'%', Types::STRING),
            new Parameter('nameRu', '%'.$dto->nameRu.'%', Types::STRING),
            new Parameter('nameUz', '%'.$dto->nameUz.'%', Types::STRING),
            new Parameter('nameUzc', '%'.$dto->nameUzc.'%', Types::STRING),
        ]);

        $query = $qb
            ->select('p')
            ->where($qb->expr()->orX(
                $qb->expr()->like("JSON_EXTRACT(p.name, '$.en')", ':nameEn'),
                $qb->expr()->like("JSON_EXTRACT(p.name, '$.ru')", ':nameRu'),
                $qb->expr()->like("JSON_EXTRACT(p.name, '$.uz')", ':nameUz'),
                $qb->expr()->like("JSON_EXTRACT(p.name, '$.uzc')", ':nameUzc')
            ))
            ->setParameters($params)
            ->getQuery();

        return $query->getOneOrNullResult();
    }
}
