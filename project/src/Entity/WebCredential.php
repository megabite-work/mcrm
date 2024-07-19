<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WebCredentialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebCredentialRepository::class)]
#[ORM\Table(name: 'web_credential')]
#[ApiResource(
    normalizationContext: ['groups' => ['web_credential:read']],
    denormalizationContext: ['groups' => ['web_credential:write', 'web_credential:update']]
)]
final class WebCredential
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_credential:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'multi_store_id')]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(name: 'class_list', type: Types::TEXT)]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?string $classList = null;

    #[ORM\Column()]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?int $article = null;

    #[ORM\Column(name: 'insta_login')]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?string $instaLogin = null;

    #[ORM\Column(name: 'insta_password')]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?string $instaPassword = null;

    #[ORM\Column(name: 'ftp_login')]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?string $ftpLogin = null;

    #[ORM\Column(name: 'ftp_password')]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?string $ftpPassword = null;

    #[ORM\Column(name: 'ftp_ip')]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?string $ftpIp = null;

    #[ORM\Column(name: 'ftp_image_path')]
    #[Groups(['web_credential:read', 'web_credential:write'])]
    private ?string $ftpImagePath = null;

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

    public function getClassList(): ?string
    {
        return $this->classList;
    }

    public function setClassList(string $classList): static
    {
        $this->classList = $classList;

        return $this;
    }

    public function getArticle(): ?int
    {
        return $this->article;
    }

    public function setArticle(int $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getInstaLogin(): ?string
    {
        return $this->instaLogin;
    }

    public function setInstaLogin(string $instaLogin): static
    {
        $this->instaLogin = $instaLogin;

        return $this;
    }

    public function getInstaPassword(): ?string
    {
        return $this->instaPassword;
    }

    public function setInstaPassword(string $instaPassword): static
    {
        $this->instaPassword = $instaPassword;

        return $this;
    }

    public function getFtpLogin(): ?string
    {
        return $this->ftpLogin;
    }

    public function setFtpLogin(string $ftpLogin): static
    {
        $this->ftpLogin = $ftpLogin;

        return $this;
    }

    public function getFtpPassword(): ?string
    {
        return $this->ftpPassword;
    }

    public function setFtpPassword(string $ftpPassword): static
    {
        $this->ftpPassword = $ftpPassword;

        return $this;
    }

    public function getFtpIp(): ?string
    {
        return $this->ftpIp;
    }

    public function setFtpIp(string $ftpIp): static
    {
        $this->ftpIp = $ftpIp;

        return $this;
    }

    public function getFtpImagePath(): ?string
    {
        return $this->ftpImagePath;
    }

    public function setFtpImagePath(string $ftpImagePath): static
    {
        $this->ftpImagePath = $ftpImagePath;

        return $this;
    }
}
