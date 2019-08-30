<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

class Serializer extends AbstractSerializer implements SerializerInterface
{
    /** @var AbstractSerializer */
    private $serializer;

    public function __construct()
    {
        parent::__construct();
        $this->serializer = $this->getSerializer();
    }

    /**
     * @param array $data
     * @return string
     */
    public function serialize(array $data): string
    {
        return $this->serializer->serialize($data, 'json');
    }
}
