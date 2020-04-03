<?php

namespace App\GameLogic\DataTransfer\Security;

use App\Entity\User;
use App\GameLogic\DataTransfer\ResponseInterface;
use JMS\Serializer\Annotation\Type;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class LoginResponse implements ResponseInterface
{
    /**
     * @Type("integer")
     * @var
     */
    public $id;

    /**
     * @Type("string")
     * @var string
     */
    public $token;

    /**
     * @Type("string")
     * @var string
     */
    public $username;

    /**
     * @Type("string")
     * @var string
     */
    public $email;

    /**
     * @Type("string")
     * @var string
     */
    public $flag;

    /**
     * @Serializer\Type("integer")
     * @var integer
     */
    public $createdAt;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->token = $user->getToken();
        $this->email = $user->getEmail();
        $this->flag = $user->getFlag();
        $this->createdAt = $user->getCreatedAt()->getTimestamp();
    }
}