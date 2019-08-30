<?php


namespace App\UserContext\Infrastructure\Serialization;


interface SymfonySerializerInterface
{
    public function serialize(array $data): string;
}