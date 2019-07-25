<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Entities\ResponseWrapper;
use App\UserContext\Infrastructure\Connections\ApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class IdentitySearchByNameRepository
{
    private $client;
    private $deserializer;

    public function __construct(
        ApiClient $client
        //$deserializer
    ) {
        $this->client       = new Client();
        $this->deserializer = new Serializer(
            //[new ObjectNormalizer(), new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new ObjectNormalizer(),],
            [new JsonEncoder()]
        );
    }

    public function search(string $name)
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
            ResponseWrapper::class,
            'json'
        );
    }
}
