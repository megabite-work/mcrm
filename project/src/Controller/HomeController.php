<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/')]
class HomeController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function index(): RedirectResponse
    {
        return new RedirectResponse('https://mcrm.uz');
    }
}
