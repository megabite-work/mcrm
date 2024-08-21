<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CashboxDetailRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CashboxDetailRepository::class)]
#[Gedmo\SoftDeleteable]
class CashboxDetail
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update', 'cashbox_payment:index', 'cashbox_payment:show', 'cashbox_payment:create'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update', 'cashbox_payment:index', 'cashbox_payment:show', 'cashbox_payment:create'])]
    private ?int $chequeNumber = null;

    #[ORM\Column(length: 255)]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    #[Assert\Choice(choices: ['sale', 'return'])]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    #[Assert\Choice(choices: ['credit', 'advance', 'credit_pay', null])]
    private ?string $creditType = null;

    #[ORM\Column(nullable: true, options: ['default' => false])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?bool $returnStatus = false;

    #[ORM\Column(nullable: true)]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?bool $creditStatus = null;

    #[ORM\Column(nullable: true, type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private null|float|string $surrender = 0;

    #[ORM\Column(nullable: true, type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private null|float|string $sale = 0;

    #[ORM\Column(nullable: true, type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private null|float|string $discount = 0;

    #[ORM\Column(nullable: true, type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private null|float|string $nds = 0;

    #[ORM\Column(nullable: true, type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private null|float|string $advance = 0;

    #[ORM\Column(nullable: true, type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private null|float|string $credit = 0;

    #[ORM\Column(nullable: true, type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private null|float|string $remain = 0;

    #[ORM\ManyToOne(inversedBy: 'cashboxDetails')]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?CashboxDetail $detail = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxDetails')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxDetails')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?Cashbox $cashbox = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxDetails')]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    private ?CounterPart $counterPart = null;

    #[ORM\OneToMany(targetEntity: CashboxDetail::class, mappedBy: 'detail')]
    #[Groups(['cashbox_detail:index', 'cashbox_detail:show'])]
    private Collection $cashboxDetails;

    #[ORM\OneToMany(targetEntity: CashboxPayment::class, mappedBy: 'cashboxDetail')]
    private Collection $cashboxPayments;

    public function __construct()
    {
        $this->cashboxDetails = new ArrayCollection();
        $this->cashboxPayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCashbox(): ?Cashbox
    {
        return $this->cashbox;
    }

    public function setCashbox(Cashbox $cashbox): static
    {
        $this->cashbox = $cashbox;

        return $this;
    }

    public function getChequeNumber(): ?int
    {
        return $this->chequeNumber;
    }

    public function setChequeNumber(int $chequeNumber): static
    {
        $this->chequeNumber = $chequeNumber;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCreditType(): ?string
    {
        return $this->creditType;
    }

    public function setCreditType(?string $creditType): static
    {
        $this->creditType = $creditType;

        return $this;
    }

    public function getReturnStatus(): ?bool
    {
        return $this->returnStatus;
    }

    public function setReturnStatus(?bool $returnStatus): static
    {
        $this->returnStatus = $returnStatus ?? false;

        return $this;
    }

    public function getCreditStatus(): ?bool
    {
        return $this->creditStatus;
    }

    public function setCreditStatus(?bool $creditStatus): static
    {
        $this->creditStatus = $creditStatus;

        return $this;
    }

    public function getDetail(): ?CashboxDetail
    {
        return $this->detail;
    }

    public function setDetail(?CashboxDetail $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getSurrender(): ?float
    {
        return $this->surrender;
    }

    public function setSurrender(?float $surrender): static
    {
        $this->surrender = $surrender ?? 0;

        return $this;
    }

    public function getSale(): ?float
    {
        return $this->sale;
    }

    public function setSale(?float $sale): static
    {
        $this->sale = $sale ?? 0;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): static
    {
        $this->discount = $discount ?? 0;

        return $this;
    }

    public function getNds(): ?float
    {
        return $this->nds;
    }

    public function setNds(?float $nds): static
    {
        $this->nds = $nds ?? 0;

        return $this;
    }

    public function getAdvance(): ?float
    {
        return $this->advance;
    }

    public function setAdvance(?float $advance): static
    {
        $this->advance = $advance ?? 0;

        return $this;
    }

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function setCredit(?float $credit): static
    {
        $this->credit = $credit ?? 0;

        return $this;
    }

    public function getRemain(): ?float
    {
        return $this->remain;
    }

    public function setRemain(?float $remain): static
    {
        $this->remain = $remain ?? 0;

        return $this;
    }

    #[Groups(['cashbox_detail:index', 'cashbox_detail:show', 'cashbox_detail:create', 'cashbox_detail:update'])]
    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->getCreatedAt();
    }

    public function getCounterPart(): ?CounterPart
    {
        return $this->counterPart;
    }

    public function setCounterPart(?CounterPart $counterPart): static
    {
        $this->counterPart = $counterPart;

        return $this;
    }

    public function getCashboxDetails(): Collection
    {
        return $this->cashboxDetails;
    }

    public function addCashboxDetail(CashboxDetail $cashboxDetail): static
    {
        if (!$this->cashboxDetails->contains($cashboxDetail)) {
            $this->cashboxDetails->add($cashboxDetail);
            $cashboxDetail->setDetail($this);
        }

        return $this;
    }

    public function removeCashboxDetail(CashboxDetail $cashboxDetail): static
    {
        if ($this->cashboxDetails->removeElement($cashboxDetail)) {
            if ($cashboxDetail->getDetail() === $this) {
                $cashboxDetail->setDetail(null);
            }
        }

        return $this;
    }

    public function getCashboxPayments(): Collection
    {
        return $this->cashboxPayments;
    }

    public function addCashboxPayment(CashboxPayment $cashboxPayment): static
    {
        if (!$this->cashboxPayments->contains($cashboxPayment)) {
            $this->cashboxPayments->add($cashboxPayment);
            $cashboxPayment->setCashboxDetail($this);
        }

        return $this;
    }

    public function removeCashboxPayment(CashboxPayment $cashboxPayment): static
    {
        if ($this->cashboxPayments->removeElement($cashboxPayment)) {
            if ($cashboxPayment->getCashboxDetail() === $this) {
                $cashboxPayment->setCashboxDetail(null);
            }
        }

        return $this;
    }
}
