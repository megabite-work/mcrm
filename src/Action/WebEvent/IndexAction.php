<?php

namespace App\Action\WebEvent;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Category\IndexDto as CategoryDto;
use App\Dto\WebEvent\IndexDto;
use App\Dto\WebEvent\RequestQueryDto;
use App\Dto\WebNomenclature\IndexDto as WebNomenclatureDto;
use App\Entity\Category;
use App\Entity\WebNomenclature;
use App\Repository\WebEventRepository;
use Doctrine\ORM\EntityManagerInterface;

class IndexAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebEventRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebEventsByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $typeIds = null;
            if ($entity->getType() === 'product') {
                $typeIds = array_map(function ($id) {
                    return WebNomenclatureDto::fromEntityForNomenclature($this->em->getRepository(WebNomenclature::class)->find($id));
                }, $entity->getTypeIds());
            } else if ($entity->getType() === 'category') {
                $typeIds = array_map(function ($id) {
                    return CategoryDto::fromEntity($this->em->getRepository(Category::class)->findCategoryByIdWithParentAndChildrens($id));
                }, $entity->getTypeIds());
            }

            $entity = IndexDto::fromEntity($entity, $typeIds);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
