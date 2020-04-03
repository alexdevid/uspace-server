<?php

namespace App\GameLogic\DataTransfer\Worlds;

use App\GameLogic\DataTransfer\RequestInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class SystemGetRequest implements RequestInterface
{
    /**
     * @Serializer\Type("integer")
     * @var int
     */
    public $id;
}