<?php

namespace App\Action\User;

use App\Component\EntityNotFoundException;
use App\Dto\User\RequestDto;
use App\Entity\Address;
use App\Entity\Phone;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): User
    {
        $user = $this->updateUser($id, $dto);

        $this->em->getRepository(Phone::class)->checkPhoneExistsAndCreate($user, $dto->getPhones());
        $this->em->getRepository(Address::class)->checkAddressExistsAndUpdateOrCreate($user, $dto);
        $this->em->flush();

        return $user;
    }

    private function updateUser(int $id, RequestDto $dto)
    {
        $user = $this->em->getRepository(User::class)->getUserWithAddressAndPhonesByUserId($id);

        if (null === $user) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getEmail()) {
            $user->setEmail($dto->getEmail());
        }

        return $user;
    }
}
