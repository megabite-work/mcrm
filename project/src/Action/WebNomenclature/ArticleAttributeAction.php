<?php

namespace App\Action\WebNomenclature;

use App\Dto\ArticleAttribute\IndexDto;
use App\Dto\WebNomenclature\RequestDto;
use App\Exception\ErrorException;
use App\Repository\ArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAttributeAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ArticleAttributeRepository $articleAttributeRepository
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = $this->articleAttributeRepository->findByMultiStoreAndArticle($dto);

        if (null === $entity) {
            throw new ErrorException('ArticleAttribute', 'not found');
        }

        return IndexDto::fromEntity($entity);
    }
}
