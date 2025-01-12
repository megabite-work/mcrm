<?php

namespace App\Action\UserCredential;

use App\Repository\UserCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(UserInterface $user, int $id): void
    {
        $entity = $this->repo->findOneBy(['id' => $id, 'owner' => $user]);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
