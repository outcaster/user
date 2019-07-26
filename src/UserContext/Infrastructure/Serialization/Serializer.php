<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

interface Serializer
{
    public function deserialize(string $body, string $classname, string $format);
}
