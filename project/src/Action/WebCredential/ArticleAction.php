<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Dto\WebCredential\RequestDto;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $repo
    ) {}

    public function __invoke(int $multiStoreId, RequestDto $dto): array
    {
        $entity = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId)->getWebCredential();

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $article = $entity->getArticle();
        $entity->setArticle($article + 1);

        $this->em->flush();

        return compact('article');
    }
}
