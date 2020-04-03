<?php

namespace App\GameLogic\DataTransfer\System;

use App\Entity\System;
use App\GameLogic\DataTransfer\GameObjectResponse;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class SystemResponse extends GameObjectResponse
{
    /**
     * @Serializer\Type("int")
     * @var int
     */
    public $id;

    /**
     * @Serializer\Type("int")
     * @var int
     */
    public $seed;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    public $size;

    /**
     * @Serializer\Type("integer")
     * @var integer
     */
    public $discoveredAt;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    public $discoveredBy;

    /**
     * @param System $system
     */
    public function __construct(System $system)
    {
        $this->id = $system->getId();
        $this->seed = $system->getSeed();
        $this->size = $system->getSize();
        $this->discoveredAt = $system->getDiscoveredAt() ? $system->getDiscoveredAt()->getTimestamp() : null;
        $this->discoveredBy = $system->getDiscoveredBy() ? $system->getDiscoveredBy()->getUsername() : null;

        parent::__construct($system);
    }
}