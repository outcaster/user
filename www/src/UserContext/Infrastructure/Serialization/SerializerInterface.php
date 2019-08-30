<?php


namespace App\UserContext\Infrastructure\Serialization;


interface SerializerInterface
{
    public function serialize(array $data): string;
}