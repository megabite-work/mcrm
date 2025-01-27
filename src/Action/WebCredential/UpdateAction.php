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

        $entity->setCatalogType($dto->catalogType ?? $entity->getCatalogType())
            ->setCatalogTypeId($dto->catalogTypeId ?? $entity->getCatalogTypeId())
            ->setBuyType($dto->buyType ?? $entity->getBuyType())
            ->setBuyValue($dto->buyValue ?? $entity->getBuyValue())
            ->setBuyTitle($dto->buyTitle ?? $entity->getBuyTitle())
            ->setSecrets($dto->secrets ?? $entity->getSecrets())
            ->setSocial($dto->social ?? $entity->getSocial())
            ->setLogo($dto->logo ?? $entity->getLogo())
            ->setTemplateId($dto->templateId ?? $entity->getTemplateId())
            ->setAbout($dto->about ?? $entity->getAbout());
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
