<?php

namespace App\Controller\User;

use App\Component\CurrentUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteAction extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private CurrentUser $user
    ) {
    }

    public function __invoke(UserInterface $data)
    {
        // print_r($user);
        return $data;
    }
}
