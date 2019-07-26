<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Entities\IdentitySearchResponseWrapper;
use App\UserContext\Domain\Repository\IdentityRepository;
use App\UserContext\Infrastructure\Connections\ApiClient;
use App\UserContext\Infrastructure\Serialization\Serializer;

class IdentitySearchByNameRepository implements IdentityRepository
{
    private $client;
    private $serializer;

    public function __construct(ApiClient $client, Serializer $serializer)
    {
        $this->client     = $client;
        $this->serializer = $serializer;
    }

    public function search(string $name) :IdentitySearchResponseWrapper
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
                $body
            );

        return $this->serializer->deserialize(
            $apiResponse->getBody()->getContents(),
            IdentitySearchResponseWrapper::class,
            'json'
        );
    }
}
