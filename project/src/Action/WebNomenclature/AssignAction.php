<?php

namespace App\Action\WebNomenclature;

use App\Dto\WebNomenclature\RequestDto;
use App\Entity\ArticleAttribute;
use App\Entity\MultiStore;
use App\Entity\WebAttributeValue;
use App\Entity\WebNomenclature;
use App\Exception\ErrorException;
use App\Repository\ArticleAttributeRepository;
use App\Repository\AttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AttributeValueRepository $attributeValueRepository,
        private ArticleAttributeRepository $articleAttributeRepository
    ) {}

    public function __invoke(RequestDto $dto): void
    {
        $webNomenclature = $this->em->getReference(WebNomenclature::class, $dto->webNomenclatureId);
        $attributeValues = $this->attributeValueRepository->findAllByItem($dto->attributeValues);

        if (count($attributeValues) <= 0) {
            throw new ErrorException('WeNomenclature', 'attribute values not found');
        }

        $attributeIds = [];
        foreach ($attributeValues as $attributeValue) {
            if ($dto->remember) {
                $attributeIds[] = $attributeValue->getAttribute()->getId();
            }

            $entity = (new WebAttributeValue())
                ->setWebNomenclature($webNomenclature)
                ->setAttributeValue($attributeValue);

            $this->em->persist($entity);
        }

        $this->createOrUpdateArticleAttribute($webNomenclature, $attributeIds);
        $this->em->flush();
    }

    private function createOrUpdateArticleAttribute(WebNomenclature $webNomenclature, array $attributeIds): void
    {
        if (count($attributeIds) > 0) {
            $multiStore = $webNomenclature->getNomenclature()->getMultiStore();
            $article = $webNomenclature->getArticle();
            $entity = $this->articleAttributeRepository->findOneBy(['multiStore' => $multiStore, 'article' => $article]);

            if (null === $entity) {
                $this->createArticleAttribute($multiStore, $article, $attributeIds);
            } else {
                $this->updateArticleAttribute($entity, $attributeIds);
            }
        }
    }

    private function createArticleAttribute(MultiStore $multiStore, string $article, array $attributeIds): void
    {
        $entity = (new ArticleAttribute())
            ->setArticle($article)
            ->setMultiStore($multiStore)
            ->setAttributes($attributeIds);

        $this->em->persist($entity);
    }

    private function updateArticleAttribute(ArticleAttribute $articleAttribute, array $attributeIds): void
    {
        $articleAttribute->setAttributes($attributeIds);
    }
}
