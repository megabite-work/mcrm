<?php

namespace App\Action\WebNomenclature;

use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);
        $this->em->remove($webNomenclature);
        $this->em->flush();
    }
}
