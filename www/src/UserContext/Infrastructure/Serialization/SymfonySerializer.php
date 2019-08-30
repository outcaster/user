<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

class SymfonySerializer extends Serializer implements SymfonySerializerInterface
{
    /** @var Serializer */
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
