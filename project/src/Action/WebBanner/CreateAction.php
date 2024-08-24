<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\RequestDto;
use App\Entity\WebBanner;
use App\Entity\MultiStore;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebBannerRepository $repo
    ) {
    }

    public function __invoke(RequestDto $dto): WebBanner
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        if (null === $multiStore) {
            throw new EntityNotFoundException('multi store not found', 404);
        }

        $entity = $this->create($multiStore, $dto);

        $this->em->flush();

        return $entity;
    }

    private function create(MultiStore $multiStore, RequestDto $dto): WebBanner
    {
        $entity = (new WebBanner())
            ->setType($dto->getType())
            ->setTypeId($dto->getTypeId())
            ->setimage($dto->getimage())
            ->setMultiStore($multiStore);

        $this->em->persist($entity);

        return $entity;
    }
}
