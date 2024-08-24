<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Dto\WebCredential\RequestDto;
use App\Entity\WebCredential;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $repo
    ) {
    }

    public function __invoke(int $multiStoreId, RequestDto $dto): WebCredential
    {
        $entity = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId)->getWebCredential();

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->update($entity, $dto);

        $this->em->flush();

        return $entity;
    }

    private function update(WebCredential $entity, RequestDto $dto): WebCredential
    {
        if ($dto->getCategory()) {
            $entity->setCategory($dto->getCategory());
        }
        if ($dto->getSecrets()) {
            $entity->setSecrets($dto->getSecrets());
        }
        if ($dto->getSocial()) {
            $entity->setSocial($dto->getSocial());
        }

        return $entity;
    }
}
