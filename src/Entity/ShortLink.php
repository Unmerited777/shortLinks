<?php

namespace App\Entity;

use App\Repository\ShortLinkRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShortLinkRepository::class)
 */
class ShortLink
{
    const SHORT_LINK_PROTOCOL = 'http';
    const SHORT_LINK_DOMAIN = 'localhost';
    const SHORT_LINK_PORT = '8000';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Url
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $fullLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortLink(): string
    {
        return $this->getBaseShortURL() . $this->getId();
    }

    public function getBaseShortURL()
    {
        return
            self::SHORT_LINK_PROTOCOL .
            '://' .
            self::SHORT_LINK_DOMAIN .
            ':' .
            self::SHORT_LINK_PORT .
            '/'
        ;
    }

    public function getFullLink(): string
    {
        return $this->fullLink;
    }

    public function setFullLink(string $fullLink): void
    {
        $this->fullLink = $fullLink;
    }
}