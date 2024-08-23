<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Dto\WebCredential\RequestDto;
use App\Entity\WebCredential;
use App\Entity\MultiStore;
use App\Repository\WebCredentialRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebCredentialRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): WebCredential
    {
        $multiStore = $this->em->getRepository(MultiStore::class)->findMultiStoreByIdWithWebCredential($dto->getMultiStoreId());

        if (!$multiStore->getWebCredential()) {
            throw new EntityNotFoundException('already exists', 400);
        }

        $entity = $this->create($multiStore, $dto);

        $this->em->flush();

        return $entity;
    }

    private function create(MultiStore $multiStore): WebCredential
    {
        $entity = (new WebCredential())
            ->setMultiStoreId($multiStore);

        $this->em->persist($entity);

        return $entity;
    }
}
