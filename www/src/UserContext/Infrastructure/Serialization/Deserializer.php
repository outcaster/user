<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

class Deserializer extends AbstractSerializer implements DeserializerInterface
{
    /** @var AbstractSerializer */
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
