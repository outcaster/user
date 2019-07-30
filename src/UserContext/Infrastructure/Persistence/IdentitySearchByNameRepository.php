<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Infrastructure\Serialization\Entities\IdentitySearchResponseWrapper;
use App\UserContext\Domain\Repository\IdentityRepository;
use App\UserContext\Infrastructure\Connections\ApiClient;
use App\UserContext\Infrastructure\Serialization\Serializer;
use App\UserContext\Infrastructure\Serialization\Adapter\IdentityToPersonAdapter;

class IdentitySearchByNameRepository implements IdentityRepository
{
    private $client;
    private $serializer;
    private $identityAdapter;

    public function __construct(
        ApiClient $client,
        Serializer $serializer,
        IdentityToPersonAdapter $identityAdapter
    )
    {
        $this->client     = $client;
        $this->serializer = $serializer;
        $this->identityAdapter = $identityAdapter;
    }

    /**
     * @param string $name
     * @return array
     */
    public function search(string $name) :array
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

        $responseWrapper = $this->serializer->deserialize(
            $apiResponse->getBody()->getContents(),
            IdentitySearchResponseWrapper::class,
            'json'
        );

        return $this->identityAdapter->parse($responseWrapper);
    }
}
