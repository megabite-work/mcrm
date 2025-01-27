<?php

namespace App\Action\WebEvent;

use App\Entity\WebBlock;
use App\Entity\WebEvent;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebEvent::class, $id);
        $block = $this->em->getRepository(WebBlock::class)->findOneby(['typeId'=> $id, 'type' => WebBlock::TYPE_EVENT]);
        $this->em->remove($entity);
        $this->em->remove($block);
        $this->em->flush();
    }
}
