<?php

namespace App\Action\WebBlock;

use App\Component\EntityNotFoundException;
use App\Dto\WebBlock\RequestDto;
use App\Entity\MultiStore;
use App\Entity\WebBannerSetting;
use App\Entity\WebBlock;
use App\Entity\WebEvent;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(RequestDto $dto): WebBlock
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId())
            ?? throw new EntityNotFoundException('multi store not found', 404);

        $entity = $this->create($dto);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): WebBlock
    {
        $typeId = $dto->getTypeId() ?? $this->checkTypeAndCreate($dto->getType(), $dto->getMultiStoreId());
        $entity = (new WebBlock())
            ->setMultiStoreId($dto->getMultiStoreId())
            ->setType($dto->getType())
            ->setTypeId($typeId)
            ->setIsActive($dto->getIsActive())
            ->setOrder($dto->getOrder());

        $this->em->persist($entity);

        return $entity;
    }

    private function checkTypeAndCreate(string $type, int $multiStoreId): int
    {
        $entity = match ($type) {
            WebBlock::TYPE_BANNER => new WebBannerSetting(),
            WebBlock::TYPE_EVENT => (new WebEvent())->setMultiStoreId($multiStoreId),
            default => throw new EntityNotFoundException('type not found', 404),
        };

        $this->em->persist($entity);
        $this->em->flush();

        return $entity->getId();
    }
}
