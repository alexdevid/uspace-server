<?php

namespace App\Service\Serializer;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

/**
 * @author Alexander Tsukanov <https://alexdevid.com>
 */
class Serializer
{
    public const FORMAT_JSON = 'json';
    public const FORMAT_XML = 'xml';
    public const FORMAT_DEFAULT = self::FORMAT_JSON;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()
            ->setObjectConstructor(new ObjectConstructor())
            ->build();
    }

    /**
     * @param mixed $serializable
     * @return string
     */
    public function serialize($serializable): string
    {
        return $this->serializer->serialize($serializable, self::FORMAT_DEFAULT);
    }

    /**
     * @param string $content
     * @param string $type
     * @return mixed
     */
    public function deserialize(string $content, string $type)
    {
        return $this->serializer->deserialize($content, $type, self::FORMAT_DEFAULT);
    }
}