<?php

namespace App\Action\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $user = $this->em->find(User::class, $id);
        $this->em->remove($user);
        $this->em->flush();
    }
}
