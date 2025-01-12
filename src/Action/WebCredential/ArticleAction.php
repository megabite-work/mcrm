<?php

namespace App\Action\WebCredential;

use App\Exception\ErrorException;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $repo
    ) {}

    public function __invoke(int $multiStoreId): array
    {
        $multiStore = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId);
        $entity = $multiStore->getWebCredential();

        if (! $entity) {
            throw new ErrorException('WebCredential', 'not found');
        }

        $article = $entity->getArticle();
        $entity->setArticle($entity->getArticle() + 1);
        $this->em->flush();

        return compact('article');
    }
}
