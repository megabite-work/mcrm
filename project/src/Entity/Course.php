<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CourseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[ORM\Table(name: 'course')]
#[ApiResource(
    normalizationContext: ['groups' => ['course:read']],
    denormalizationContext: ['groups' => ['course:write', 'course:update']]
)]
final class Course
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['course:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'multi_store_id')]
    #[Groups(['course:read', 'course:write'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(name: 'currency_id')]
    #[Groups(['course:read', 'course:write'])]
    private ?int $currencyId = null;

    #[ORM\Column(name: 'cape_amount', type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['course:read', 'course:write'])]
    private ?string $capeAmount = null;

    #[ORM\Column(name: 'cape_type')]
    #[Groups(['course:read', 'course:write'])]
    private ?string $capeType = null;

    #[ORM\Column()]
    #[Groups(['course:read', 'course:write'])]
    private ?int $convert = null;

    #[ORM\Column(name: 'currency_value', type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['course:read', 'course:write'])]
    private ?string $currencyValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    public function setCurrencyId(int $currencyId): static
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    public function getCapeAmount(): ?string
    {
        return $this->capeAmount;
    }

    public function setCapeAmount(string $capeAmount): static
    {
        $this->capeAmount = $capeAmount;

        return $this;
    }

    public function getCapeType(): ?string
    {
        return $this->capeType;
    }

    public function setCapeType(string $capeType): static
    {
        $this->capeType = $capeType;

        return $this;
    }

    public function getConvert(): ?int
    {
        return $this->convert;
    }

    public function setConvert(int $convert): static
    {
        $this->convert = $convert;

        return $this;
    }

    public function getCurrencyValue(): ?string
    {
        return $this->currencyValue;
    }

    public function setCurrencyValue(string $currencyValue): static
    {
        $this->currencyValue = $currencyValue;

        return $this;
    }
}