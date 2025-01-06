<?php

namespace App\Action\UserCredential;

use App\Component\CurrentUser;
<<<<<<< HEAD
use App\Dto\UserCredential\IndexDto;
use App\Dto\UserCredential\RequestDto;
use App\Entity\UserCredential;
use App\Exception\ErrorException;
=======
use App\Component\EntityNotFoundException;
use App\Dto\UserCredential\RequestDto;
use App\Entity\UserCredential;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
use App\Repository\UserCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CurrentUser $user,
        private UserCredentialRepository $repo
<<<<<<< HEAD
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = $this->repo->findUserCredentialByType($this->user->getUser(), $dto->getType());

        if (null !== $entity) {
            throw new ErrorException('UserCredential', 'already exists');
        }

        $entity = (new UserCredential())
=======
    ) {
    }

    public function __invoke(RequestDto $dto): UserCredential
    {
        $userCredential = $this->repo->findUserCredentialByType($this->user->getUser(), $dto->getType());

        if (null !== $userCredential) {
            throw new EntityNotFoundException('credential already exists');
        }

        $userCredential = (new UserCredential())
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
            ->setType($dto->getType())
            ->setOwner($this->user->getUser())
            ->setValue($dto->getValue());

<<<<<<< HEAD
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
=======
        $this->em->persist($userCredential);
        $this->em->flush();

        return $userCredential;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    }
}
