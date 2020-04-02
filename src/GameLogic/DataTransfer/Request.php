<?php

namespace App\GameLogic\DataTransfer;

use JMS\Serializer\Annotation\Type;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class Request
{
    /**
     * @Type("string")
     * @var string
     */
    public $uid;

    /**
     * @Type("string")
     * @var string
     */
    public $method;

    /**
     * @Type("array")
     * @var array
     */
    public $data = [];

    /**
     * @return string|null
     */
    public function getService(): ?string
    {
        $stringArray = explode('.', $this->method);

        return $stringArray[0] ?? null;
    }

    /**
     * @return string|null
     */
    public function getAction(): ?string
    {
        $stringArray = explode('.', $this->method);

        return $stringArray[1] ?? null;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }
}