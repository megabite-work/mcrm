<?php

namespace App\Action\Region;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Region\IndexDto;
use App\Entity\Region;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;

class IndexAction
{
    public function __construct(
        private RegionRepository $repo,
        private EntityManagerInterface $em
    ) {}

    public function __invoke(?int $parentId): ListResponseDtoInterface
    {
        if (empty($parentId)) {
            $entities = $this->repo->findBy(['parent' => null]);
        } else {
            $parent = $this->em->getReference(Region::class, $parentId);
            $entities = $this->repo->findBy(['parent' => $parent]);
        }

        $data = array_map(fn(Region $entity) => IndexDto::fromEntity($entity), $entities);

        return new ListResponseDto($data);
    }
}
