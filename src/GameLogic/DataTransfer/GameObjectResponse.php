<?php

namespace App\GameLogic\DataTransfer;

use App\Entity\GameObject;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class GameObjectResponse implements ResponseInterface
{
    /**
     * @Serializer\Type("string")
     * @var string
     */
    public $name;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    public $publicName;

    /**
     * @Serializer\Type("float")
     * @var float
     */
    public $positionX;

    /**
     * @Serializer\Type("float")
     * @var float
     */
    public $positionY;

    /**
     * @Serializer\Type("float")
     * @var float
     */
    public $speed;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    public $owner;

    /**
     * @param GameObject $go
     */
    public function __construct(GameObject $go)
    {
        $this->name = $go->getName();
        $this->publicName = $go->getPublicName();
        $this->positionX = $go->getX();
        $this->positionY = $go->getY();
        $this->speed = $go->getSpeed();
        $this->owner = $go->getOwner() ? $go->getOwner()->getUsername() : null;
    }
}