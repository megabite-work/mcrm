<?php

namespace App\Action\PaymentType;

use App\Dto\PaymentType\IndexDto;
use App\Dto\PaymentType\RequestDto;
use App\Entity\PaymentType;
use App\Exception\ErrorException;
use App\Repository\PaymentTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PaymentTypeRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        if ($this->repo->findPaymentTypeOrNull($dto)) {
            throw new ErrorException('PaymentType', 'name already exists', Response::HTTP_BAD_REQUEST);
        }

        $entity = (new PaymentType())->setName($dto->getName())->setType($dto->type);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
