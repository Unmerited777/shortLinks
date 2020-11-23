<?php

namespace App\Entity;

use App\Repository\RedirectCounterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RedirectCounterRepository::class)
 */
class RedirectCounter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $redirected_date;

    /**
     * @ORM\ManyToOne(targetEntity="ShortLink")
     * @ORM\JoinColumn(name="short_link_id", referencedColumnName="id", nullable=false)
     */
    private $shortLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setShortLink(ShortLink $shortLink): self
    {
        $this->shortLink = $shortLink;

        return $this;
    }

    public function getShortLink(): ? ShortLink
    {
        return $this->shortLink;
    }

    public function getRedirectedDate(): ?\DateTimeInterface
    {
        return $this->redirected_date;
    }

    public function setRedirectedDate(\DateTimeInterface $redirected_date): self
    {
        $this->redirected_date = $redirected_date;

        return $this;
    }
}
