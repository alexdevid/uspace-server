<?php

namespace App\GameLogic\DataTransfer\Security;

use App\GameLogic\DataTransfer\RequestInterface;
use JMS\Serializer\Annotation\Type;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class LoginRequest implements RequestInterface
{
    /**
     * @Type("string")
     * @var string
     */
    private $username;

    /**
     * @Type("string")
     * @var string
     */
    private $password;

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
}