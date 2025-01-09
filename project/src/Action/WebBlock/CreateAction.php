<?php

namespace App\Action\WebBlock;

use App\Dto\WebBlock\IndexDto;
use App\Dto\WebBlock\RequestDto;
use App\Entity\WebBannerSetting;
use App\Entity\WebBlock;
use App\Entity\WebEvent;
use App\Exception\ErrorException;
use App\Repository\WebBlockRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebBlockRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $typeId = $dto->typeId ?? $this->checkTypeAndCreate($dto->type, $dto->multiStoreId);
        $entity = (new WebBlock())
            ->setMultiStoreId($dto->multiStoreId)
            ->setType($dto->type)
            ->setTitle($dto->title)
            ->setTypeId($typeId)
            ->setIsActive($dto->isActive)
            ->setOrder($this->repo->getLatestOrder($dto->multiStoreId) + 1);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function checkTypeAndCreate(string $type, int $multiStoreId): int
    {
        $entity = match ($type) {
            WebBlock::TYPE_BANNER => new WebBannerSetting(),
            WebBlock::TYPE_EVENT => (new WebEvent())->setMultiStoreId($multiStoreId),
            default => throw new ErrorException('WebBlock', 'type not found'),
        };

        $this->em->persist($entity);
        $this->em->flush();

        return $entity->getId();
    }
}
