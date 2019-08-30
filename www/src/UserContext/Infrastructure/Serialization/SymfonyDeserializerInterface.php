<?php


namespace App\UserContext\Infrastructure\Serialization;


interface SymfonyDeserializerInterface
{
    public function deserialize(string $body, string $classname, string $format);
}