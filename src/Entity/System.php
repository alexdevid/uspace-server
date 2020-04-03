<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SystemRepository")
 */
class System extends GameObject
{
    public const SIZE_TINY = "tiny";
    public const SIZE_SMALL = "small";
    public const SIZE_MEDIUM = "medium";
    public const SIZE_LARGE = "large";
    public const SIZE_EXTRA_LARGE = "extra_large";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $seed;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $size;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private $discoveredAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @var User|null
     */
    private $discoveredBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeed(): ?int
    {
        return $this->seed;
    }

    public function setSeed(int $seed): self
    {
        $this->seed = $seed;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDiscoveredAt(): ?\DateTimeInterface
    {
        return $this->discoveredAt;
    }

    public function setDiscoveredAt(?\DateTimeInterface $discoveredAt): self
    {
        $this->discoveredAt = $discoveredAt;

        return $this;
    }

    public function getDiscoveredBy(): ?User
    {
        return $this->discoveredBy;
    }

    public function setDiscoveredBy(?User $discoveredBy): self
    {
        $this->discoveredBy = $discoveredBy;

        return $this;
    }
}
