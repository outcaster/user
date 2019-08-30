<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

use Symfony\Component\Serializer\Serializer;
use App\UserContext\Infrastructure\Serialization\Serializer as AbstractSerializerClass;

class SymfonyDeserializer extends AbstractSerializerClass implements SymfonyDeserializerInterface
{
    /** @var Serializer */
    private $serializer;

    public function __construct()
    {
        parent::__construct();
        $this->serializer = $this->getSerializer();
    }

    /**
     * @param string $body
     * @param string $classname
     * @param string $format
     * @return object
     */
    public function deserialize(string $body, string $classname, string $format)
    {
        return $this->serializer->deserialize(
            $body,
            $classname,
            $format
        );
    }
}
