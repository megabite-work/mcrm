<?php

namespace App\Action\User;

use App\Dto\User\IndexDto;
use App\Dto\User\RequestDto;
use App\Repository\AddressRepository;
use App\Repository\PhoneRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AddressRepository $addressRepository,
        private PhoneRepository $phoneRepository,
        private UserRepository $repo
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->repo->getUserWithAddressAndPhonesByUserId($id);
        $entity->setEmail($dto->email ?? $entity->getEmail());
        $this->phoneRepository->checkPhoneExistsAndCreate($entity, $dto->phones);
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($entity, $dto);
        $this->em->flush();

        return IndexDto::fromShowAction($entity);
    }
}
