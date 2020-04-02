<?php

namespace App\GameLogic\DataTransfer;

use JMS\Serializer\Annotation\Type;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
abstract class Response implements ResponseInterface
{
    /**
     * @Type("string")
     * @var string
     */
    public $uid;
}