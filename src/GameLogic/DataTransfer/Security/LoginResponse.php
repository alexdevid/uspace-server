<?php

namespace App\GameLogic\DataTransfer\Security;

use App\Entity\User;
use App\GameLogic\DataTransfer\Response;
use JMS\Serializer\Annotation\Type;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class LoginResponse extends Response
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
     * @Type("DateTime")
     * @var \DateTime
     */
    public $createdAt;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->token = $user->getToken();
        $this->email = $user->getEmail();
        $this->flag = $user->getFlag();
        $this->createdAt = $user->getCreatedAt();
    }
}