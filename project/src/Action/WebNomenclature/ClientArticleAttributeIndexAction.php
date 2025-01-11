<?php

namespace App\Action\WebNomenclature;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\ClientArticleAttribute\IndexDto;
use App\Entity\MultiStore;
use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeIndexAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {}

    public function __invoke(int $multiStoreId, string $article): ListResponseDtoInterface
    {
        $multiStore = $this->em->getReference(MultiStore::class, $multiStoreId);
        $entities = $this->repo->findBy(['multiStore' => $multiStore, 'article' => $article]);
        $data = array_map(fn($entity) => IndexDto::fromEntity($entity), $entities);

        return new ListResponseDto($data);
    }
}
