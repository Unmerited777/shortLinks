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
    const SHORT_LINK_PREFIX = 'sl';

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
        return $this->getBaseShortURL() . self::SHORT_LINK_PREFIX . str_pad($this->getId(), 7, 0,STR_PAD_LEFT);
    }

    public static function getIdFromShortLink(string $shortLinkId) : int
    {
        return (int) str_replace(self::SHORT_LINK_PREFIX, '', $shortLinkId);
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