<?php


namespace App\UserContext\Infrastructure\Serialization;


interface DeserializerInterface
{
    public function deserialize(string $body, string $classname, string $format);
}