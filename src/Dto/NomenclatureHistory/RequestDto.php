<?php

namespace App\Dto\NomenclatureHistory;

use App\Entity\ForgiveType;
use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(groups: ['nomenclature_history:create'])]
        #[Exists(Store::class)]
        public ?int $storeId,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(groups: ['nomenclature_history:create'])]
        #[Exists(Nomenclature::class)]
        public ?int $nomenclatureId,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        #[Exists(ForgiveType::class)]
        public ?int $forgiveTypeId,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        public ?string $comment,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        public ?float $qty = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        public ?float $oldPrice = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        public ?float $price = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        public ?float $oldPriceCourse = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        public ?float $priceCourse = 0,
    ) {}
}
