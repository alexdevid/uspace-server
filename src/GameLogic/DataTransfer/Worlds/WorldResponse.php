<?php

namespace App\GameLogic\DataTransfer\Worlds;

use App\GameLogic\DataTransfer\ResponseInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class WorldResponse implements ResponseInterface
{
    /**
     * @Serializer\Type("int")
     * @var int
     */
    public $id;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    public $name;

    /**
     * @Serializer\Type("integer")
     * @var integer
     */
    public $createdAt;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    public $status;

    /**
     * @Serializer\Type("integer")
     * @var integer
     */
    public $seed;

    /**
     * @Serializer\Type("integer")
     * @var integer
     */
    public $systemsTotal;

    /**
     * @Serializer\Type("integer")
     * @var integer
     */
    public $maxPlayers;

    /**
     * @Serializer\Type("integer")
     * @var integer
     */
    public $currentPlayers;

    public function __construct()
    {
        $this->id = 32;
        $this->name = "Eva";
        $this->createdAt = time();
        $this->status = 1;
        $this->seed = 393108462;
        $this->systemsTotal = 50000;
        $this->maxPlayers = 10000;
        $this->currentPlayers = 1320;
    }
}