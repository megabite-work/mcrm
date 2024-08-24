<?php

namespace App\Dto\CashboxGlobal;

use App\Component\EntityNotFoundException;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    #[Groups(['cashbox_global:create'])]
    #[Assert\NotBlank(groups: ['cashbox_global:create'])]
    private ?int $cashboxDetailId;
    #[Groups(['cashbox_global:create'])]
    #[Assert\Valid()]
    #[Assert\All(constraints: [new Assert\Type(type: UpdateRequestDto::class)])]
    private array $items;

    public function __construct(int $cashboxDetailId, array $items)
    {
        $this->cashboxDetailId = $cashboxDetailId;
        $this->items = $this->mapItems($items);
    }

    public function getCashboxDetailId(): ?int
    {
        return $this->cashboxDetailId;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function mapItems(array $items): array
    {
        try {
            return array_map(function ($item) {
                return new UpdateRequestDto(
                    $item['nomenclatureId'],
                    $item['qty'] ?? null,
                    $item['oldPrice'] ?? null,
                    $item['price'] ?? null,
                    $item['oldPriceCourse'] ?? null,
                    $item['priceCourse'] ?? null,
                    $item['nds'] ?? null,
                    $item['ndsSum'] ?? null,
                    $item['discount'] ?? null,
                    $item['discountSum'] ?? null,
                );
            }, $items);
        } catch (\Throwable $th) {
            throw new EntityNotFoundException('nomenclatureId should be int, null given', 422);
        }
    }
}
