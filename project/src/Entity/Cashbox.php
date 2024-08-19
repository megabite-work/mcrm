<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CashboxRepository;

#[ORM\Entity(repositoryClass: CashboxRepository::class)]
#[Gedmo\SoftDeleteable]
class Cashbox
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Store $store = null;

    #[ORM\Column(length: 255)]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?string $name = null;

    #[ORM\Column(options: ['default' => 1])]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?int $chequeNumber = 1;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?string $terminalId = null;

    #[ORM\Column(options: ['default' => 1])]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?int $shiftNumber = 1;

    #[ORM\Column(options: ['default' => 1])]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?int $zNumber = 1;

    #[ORM\Column(options: ['default' => 1])]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?int $xNumber = 1;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?string $workplace = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?string $humoArcusFolder = null;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['cashbox:index', 'cashbox:show', 'cashbox:create', 'cashbox:update'])]
    private ?bool $isActive = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): static
    {
        $this->store = $store;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getChequeNumber(): ?int
    {
        return $this->chequeNumber;
    }

    public function setChequeNumber(?int $chequeNumber): static
    {
        $this->chequeNumber = $chequeNumber;

        return $this;
    }

    public function getTerminalId(): ?string
    {
        return $this->terminalId;
    }

    public function setTerminalId(?string $terminalId): static
    {
        $this->terminalId = $terminalId;

        return $this;
    }

    public function getShiftNumber(): ?int
    {
        return $this->shiftNumber;
    }

    public function setShiftNumber(?int $shiftNumber): static
    {
        $this->shiftNumber = $shiftNumber;

        return $this;
    }

    public function getZNumber(): ?int
    {
        return $this->zNumber;
    }

    public function setZNumber(?int $zNumber): static
    {
        $this->zNumber = $zNumber;

        return $this;
    }

    public function getXNumber(): ?int
    {
        return $this->xNumber;
    }

    public function setXNumber(?int $xNumber): static
    {
        $this->xNumber = $xNumber;

        return $this;
    }

    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    public function setWorkplace(?string $workplace): static
    {
        $this->workplace = $workplace;

        return $this;
    }

    public function getHumoArcusFolder(): ?string
    {
        return $this->humoArcusFolder;
    }

    public function setHumoArcusFolder(?string $humoArcusFolder): static
    {
        $this->humoArcusFolder = $humoArcusFolder;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
