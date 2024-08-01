<?php

namespace App\Entity;

use App\Repository\ForgiveTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ForgiveTypeRepository::class)]
#[ORM\Table(name: 'forgive_type')]
#[Gedmo\SoftDeleteable]
class ForgiveType
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['forgive_type:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['forgive_type:read'])]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
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
}
