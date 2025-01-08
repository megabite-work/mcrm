<?php

namespace App\Action\UserCredential;

use App\Component\CurrentUser;
use App\Dto\UserCredential\IndexDto;
use App\Dto\UserCredential\RequestDto;
use App\Entity\UserCredential;
use App\Exception\ErrorException;
use App\Repository\UserCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CurrentUser $user,
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = $this->repo->findUserCredentialByType($this->user->getUser(), $dto->getType());

        if (null !== $entity) {
            throw new ErrorException('UserCredential', 'already exists');
        }

        $entity = (new UserCredential())
            ->setType($dto->getType())
            ->setOwner($this->user->getUser())
            ->setValue($dto->getValue());

        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
