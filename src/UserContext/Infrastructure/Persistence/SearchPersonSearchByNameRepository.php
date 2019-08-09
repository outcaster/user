<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Infrastructure\Serialization\Entities\IdentitySearchResponseWrapper;
use App\UserContext\Domain\Repository\SearchPersonRepository;
use App\UserContext\Infrastructure\Connections\ApiClient;
use App\UserContext\Infrastructure\Serialization\Serializer;
use App\UserContext\Infrastructure\Serialization\Adapter\IdentityToPersonAdapter;

class SearchPersonSearchByNameRepository implements SearchPersonRepository
{
    /** @var ApiClient  */
    private $client;

    /** @var Serializer  */
    private $serializer;

    /** @var IdentityToPersonAdapter  */
    private $identityAdapter;

    /** @var string */
    private $apiEndpoint;

    public function __construct(
        ApiClient $client,
        Serializer $serializer,
        IdentityToPersonAdapter $identityAdapter,
        string $apiEndpoint
    ) {
        $this->client     = $client;
        $this->serializer = $serializer;
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
                $this->apiEndpoint . '/v1/identity/searchby',
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
