<?php

namespace App\Action\UserCredential;

use App\Entity\User;
use App\Entity\UserCredential;
use App\Dto\UserCredential\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(User $user, RequestDto $dto): UserCredential
    {
        $userCredential = $this->em->getRepository(UserCredential::class)->findUserCredentialByType($user, $dto->getType());

        if (null !== $userCredential) {
            throw new EntityNotFoundException('credential already exists');
        }

        $userCredential = (new UserCredential())
            ->setType($dto->getType())
            ->setOwner($user)
            ->setValue($dto->getValue());

        $this->em->persist($userCredential);
        $this->em->flush();

        return $userCredential;
    }
}
