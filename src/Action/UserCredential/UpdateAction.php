<?php

namespace App\Action\UserCredential;

use App\Dto\UserCredential\IndexDto;
use App\Dto\UserCredential\RequestDto;
use App\Entity\UserCredential;
use App\Exception\ErrorException;
use App\Repository\UserCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(UserInterface $user, int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->repo->findOneBy(['id' => $id, 'owner' => $user, 'type' => $dto->getType()]);

        if (! $entity) {
            throw new ErrorException('UserCredential', 'not found', Response::HTTP_NOT_FOUND);
        }

        $entity = match ($dto->getType()) {
            'company' => $this->updateCompany($entity, $dto),
            'click' => $this->updateClick($entity, $dto),
            'payme' => $this->updatePayme($entity, $dto),
            'uzum' => $this->updateUzum($entity, $dto),
            default => $entity
        };
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function updateCompany(UserCredential $entity, RequestDto $dto): UserCredential
    {
        $entity->setValue([
            'inn' => $dto->inn ?: $entity->getValue()['inn'],
            'kindOf' => $dto->kindOf ?: $entity->getValue()['kindOf'],
            'name' => $dto->name ?: $entity->getValue()['name'],
            'director' => $dto->director ?: $entity->getValue()['director'],
            'address' => $dto->address ?: $entity->getValue()['address'],
            'phones' => $dto->phones ?: $entity->getValue()['phones'],
            'oferta' => $dto->oferta,
        ]);

        return $entity;
    }

    private function updateClick(UserCredential $entity, RequestDto $dto): UserCredential
    {
        $entity->setValue([
            'serviceId' => $dto->serviceId ?: $entity->getValue()['serviceId'],
            'merchantId' => $dto->merchantId ?: $entity->getValue()['merchantId'],
            'secretKey' => $dto->secretKey ?: $entity->getValue()['secretKey'],
            'merchantUserId' => $dto->merchantUserId ?: $entity->getValue()['merchantUserId'],
        ]);

        return $entity;
    }

    private function updatePayme(UserCredential $entity, RequestDto $dto): UserCredential
    {
        $entity->setValue([
            'merchantId' => $dto->merchantId ?: $entity->getValue()['merchantId'],
        ]);

        return $entity;
    }

    private function updateUzum(UserCredential $entity, RequestDto $dto): UserCredential
    {
        $entity->setValue([
            'xTerminalId' => $dto->xTerminalId ?: $entity->getValue()['xTerminalId'],
            'xApiKey' => $dto->xApiKey ?: $entity->getValue()['xApiKey'],
        ]);

        return $entity;
    }
}
