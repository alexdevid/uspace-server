<?php

namespace App\GameLogic\DataTransfer\Security;

use App\GameLogic\DataTransfer\RequestInterface;
use JMS\Serializer\Annotation\Type;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class AuthRequest implements RequestInterface
{
    /**
     * @Type("string")
     * @var string
     */
    private $token;

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
}