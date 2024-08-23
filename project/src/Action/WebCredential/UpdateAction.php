<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Dto\WebCredential\RequestDto;
use App\Entity\WebCredential;
use App\Repository\WebCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebCredentialRepository $repo
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): WebCredential
    {
        $cashbox = $this->repo->findCashboxByIdWithStore($id);

        if (null === $cashbox) {
            throw new EntityNotFoundException('not found');
        }

        // $cashbox = $this->updateCashbox($cashbox, $dto);

        $this->em->flush();

        return $cashbox;
    }

}
