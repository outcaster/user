<?php


namespace App\UserContext\Infrastructure\Serialization;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Serializer;
use App\UserContext\Infrastructure\Serialization\Serializer as SerializerInterface;

class SymfonySerializer implements SerializerInterface
{
    private $serializer;

    public function __construct()
    {
        $objectNormalizer = new ObjectNormalizer(null, null, null, new PhpDocExtractor());

        $this->serializer = new Serializer(
            [$objectNormalizer, new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
    }

    public function deserialize(string $body, string $classname, string $format)
    {
        return $this->serializer->deserialize(
            $body,
            $classname,
            $format
        );
    }
}