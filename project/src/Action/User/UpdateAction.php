<?php

namespace App\Action\User;

use App\Entity\User;
use App\Dto\User\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Entity\Address;
use App\Entity\Phone;

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
