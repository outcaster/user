<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class Serializer
{
    /** @var \Symfony\Component\Serializer\Serializer */
    private $serializer;

    /**
     * SymfonySerializer constructor.
     */
    public function __construct()
    {
        $this->serializer = $this->getDefaultSerializer();
    }

    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    public function getSerializer():\Symfony\Component\Serializer\Serializer
    {
        return $this->serializer;
    }

    /**
     * @return ObjectNormalizer
     */
    protected function getDefaultNormalizer()
    {
        return new ObjectNormalizer(
            null,
            new CamelCaseToSnakeCaseNameConverter(),
            null,
            new PhpDocExtractor()
        );
    }

    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    protected function getDefaultSerializer()
    {
        return new \Symfony\Component\Serializer\Serializer(
            [
                $this->getDefaultNormalizer(),
                new GetSetMethodNormalizer(),
                new ArrayDenormalizer(),
            ],
            [new JsonEncoder()]
        );
    }
}
