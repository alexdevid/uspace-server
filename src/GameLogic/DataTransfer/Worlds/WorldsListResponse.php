<?php

namespace App\GameLogic\DataTransfer\Worlds;

use App\GameLogic\DataTransfer\ResponseInterface;
use JMS\Serializer\Annotation\Type;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class WorldsListResponse implements ResponseInterface
{
    /**
     * @Type("array")
     * @var array
     */
    public $worlds = [];
}