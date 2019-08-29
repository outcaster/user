<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

interface Serializer
{
    /**
     * Deserializes data into the given type.
     *
     * @param string  $body
     * @param string $classname
     * @param string $format
     *
     * @return object
     */
    public function deserialize(string $body, string $classname, string $format);
}
