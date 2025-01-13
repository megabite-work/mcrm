<?php

namespace App\Action\WebCredential;

use App\Dto\WebCredential\IndexDto;
use App\Dto\WebCredential\RequestDto;
use App\Entity\WebCredential;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $repo
    ) {}

    public function __invoke(int $multiStoreId, RequestDto $dto): IndexDto
    {
        $multiStore = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId);
        $entity = $multiStore->getWebCredential();

        if (! $entity) {
            $entity = (new WebCredential())->setMultiStore($multiStore);
        }

        $entity->setCatalogType($dto->catalogType)
            ->setCatalogTypeId($dto->catalogTypeId)
            ->setBuyType($dto->buyType)
            ->setBuyValue($dto->buyValue)
            ->setSecrets($dto->secrets)
            ->setSocial($dto->social)
            ->setLogo($dto->logo)
            ->setTemplateId($dto->templateId)
            ->setAbout($dto->about);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
