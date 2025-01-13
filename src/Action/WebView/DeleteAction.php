<?php

namespace App\Action\WebView;

use App\Entity\WebView;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebView::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
