<?php

namespace Daday\UrlShortenerBundle\Entity;

use Daday\UrlShortenerBundle\Repository\UrlRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\ByteString;

#[ORM\Entity(repositoryClass: UrlRepository::class)]
#[ORM\Table(name: 'shortener_url')]
#[ORM\Index(columns: ['short_code'], name: 'shortner_url_short_code_idx')]
class Url
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $original = null;

    #[ORM\Column(length: 6, nullable: false)]
    private ?string $shortCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    public function setOriginal(string $original): static
    {
        $this->original = $original;
        $this->shortCode = ByteString::fromRandom(6)->toString();
        return $this;
    }

    public function getShortCode(): ?string
    {
        return $this->shortCode;
    }

    public function setShortCode(?string $shortCode): static
    {
        $this->shortCode = $shortCode;

        return $this;
    }
}
