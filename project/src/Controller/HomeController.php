<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/')]
class HomeController extends AbstractController
{
    public function __invoke(): RedirectResponse
    {
        return new RedirectResponse('https://mcrm.uz', Response::HTTP_MOVED_PERMANENTLY);
    }
}
