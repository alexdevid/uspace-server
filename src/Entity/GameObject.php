<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
abstract class GameObject
{
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    protected $publicName;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @var float
     */
    protected $x;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @var float
     */
    protected $y;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @var float
     */
    protected $speed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="systems")
     * @var User|null
     */
    protected $owner;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return GameObject
     */
    public function setName(string $name): GameObject
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublicName(): string
    {
        return $this->publicName;
    }

    /**
     * @param string $publicName
     * @return GameObject
     */
    public function setPublicName(string $publicName): GameObject
    {
        $this->publicName = $publicName;

        return $this;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     * @return GameObject
     */
    public function setX(float $x): GameObject
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     * @return GameObject
     */
    public function setY(float $y): GameObject
    {
        $this->y = $y;

        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     * @return GameObject
     */
    public function setSpeed(float $speed): GameObject
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    /**
     * @param User|null $owner
     * @return GameObject
     */
    public function setOwner(?User $owner): GameObject
    {
        $this->owner = $owner;

        return $this;
    }
}