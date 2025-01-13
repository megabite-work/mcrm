<?php

namespace App\Action\WebView;

use App\Dto\WebView\IndexDto;
use App\Repository\WebViewRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebViewRepository $repo
    ) {}

    public function __invoke(int $multiStoreId, array $dtos): array
    {
        $entities = $this->repo->findBy(['multiStoreId' => $multiStoreId]);
        $dtoMap = [];
        foreach ($dtos as $dto) {
            $dtoMap[$dto->id] = $dto;
        }
        
        $data = array_map(function ($entity) use ($dtoMap) {
            if (isset($dtoMap[$entity->getId()])) {
                $dto = $dtoMap[$entity->getId()];
                $entity->setType($dto->type)->setIsActive($dto->isActive);
                IndexDto::fromEntity($entity);
            }
        }, $entities);
        $this->em->flush();

        return $data;
    }
}
