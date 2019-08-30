<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Infrastructure\Serialization\DeserializerInterface;
use App\UserContext\Infrastructure\Serialization\Entities\IdentitySearchResponseWrapper;
use App\UserContext\Domain\Repository\FindPersonByNameInterface;
use App\UserContext\Infrastructure\Connections\ApiClient;
use App\UserContext\Infrastructure\Serialization\Adapter\IdentityToPersonAdapter;

class FindPersonByNameRepository implements FindPersonByNameInterface
{
    /** @var ApiClient  */
    private $client;

    /** @var DeserializerInterface  */
    private $deserializer;

    /** @var IdentityToPersonAdapter  */
    private $identityAdapter;

    /** @var string */
    private $apiEndpoint;

    /**
     * @var int $maxResults indicates the maximum
     * of elements it will get to protect the API calls
     */
    private $maxResults = 10;

    public function __construct(
        ApiClient $client,
        DeserializerInterface $deserializer,
        IdentityToPersonAdapter $identityAdapter,
        string $apiEndpoint
    ) {
        $this->client     = $client;
        $this->deserializer = $deserializer;
        $this->identityAdapter = $identityAdapter;
        $this->apiEndpoint = $apiEndpoint;
    }

    /**
     * @param string $name
     * @return array
     */
    public function search(string $name) :array
    {
        $body = [
            'limit' => [
                'start' => 0,
                'count' => $this->maxResults,
            ],
            'criteria' => [
                'field' => 'name',
                'operator' => '=',
                'value' => $name,
            ]
        ];

        $apiResponse = $this
            ->client
            ->post(
                $this->apiEndpoint . '/v1/identity/searchby',
                $body
            );

        $responseWrapper = $this->deserializer->deserialize(
            $apiResponse->getBody()->getContents(),
            IdentitySearchResponseWrapper::class,
            'json'
        );

        return $this->identityAdapter->parse($responseWrapper);
    }
}
