<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Entities\IdentitySearchResponseWrapper;
use App\UserContext\Domain\Repository\IdentityRepository;
use App\UserContext\Infrastructure\Connections\ApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Serializer;

class IdentitySearchByNameRepository implements IdentityRepository
{
    private $client;
    private $deserializer;

    public function __construct(
        ApiClient $client
        //$deserializer
    ) {

        $objectNormalizer = new ObjectNormalizer(null, null, null, new PhpDocExtractor());

        $this->client       = new Client();
        $this->deserializer = new Serializer(
            [$objectNormalizer, new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            //[new $objectNormalizer,],
            [new JsonEncoder()]
        );
    }

    public function search(string $name): IdentitySearchResponseWrapper
    {
        $body = [
            'criteria' => [
                'and' => [
                    [
                        'field' => 'name',
                        'operator' => '=',
                        'value' => $name,
                    ]
                ]
            ]
        ];

        $apiResponse = $this
            ->client
            ->post(
                'http://localhost/dpm/public/index.php/v1/identity/searchby',
                [
                    RequestOptions::JSON => $body,
                ]
            );

        return $this->deserializer->deserialize(
            $apiResponse->getBody()->getContents(),
            IdentitySearchResponseWrapper::class,
            'json'
        );
    }
}
