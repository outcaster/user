<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractSerializer
{
    /** @var Serializer */
    private $serializer;

    /**
     * SymfonySerializer constructor.
     */
    public function __construct()
    {
        $this->serializer = $this->getDefaultSerializer();
    }

    /**
     * @return Serializer
     */
    public function getSerializer():Serializer
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
     * @return Serializer
     */
    protected function getDefaultSerializer()
    {
        return new Serializer(
            [
                $this->getDefaultNormalizer(),
                new GetSetMethodNormalizer(),
                new ArrayDenormalizer(),
            ],
            [new JsonEncoder()]
        );
    }
}
