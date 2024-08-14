<?php

namespace App\Action\UserCredential;

use App\Component\CurrentUser;
use App\Component\EntityNotFoundException;
use App\Dto\UserCredential\RequestDto;
use App\Entity\UserCredential;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CurrentUser $user
    ) {
    }

    public function __invoke(RequestDto $dto): UserCredential
    {
        $userCredential = $this->em->getRepository(UserCredential::class)->findUserCredentialByType($this->user, $dto->getType());

        if (null !== $userCredential) {
            throw new EntityNotFoundException('credential already exists');
        }

        $userCredential = (new UserCredential())
            ->setType($dto->getType())
            ->setOwner($this->user->getUser())
            ->setValue($dto->getValue());

        $this->em->persist($userCredential);
        $this->em->flush();

        return $userCredential;
    }
}
