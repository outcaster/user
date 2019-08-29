<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;
use App\UserContext\Infrastructure\Connections\ApiClient;
use App\UserContext\Infrastructure\Serialization\SymfonyDeserializer as Serializer;
use App\UserContext\Infrastructure\Serialization\Entities\ContactInformationSearchResponseWrapper;
use App\UserContext\Infrastructure\Serialization\Adapter\ContactInformationToPhoneNumberAdapter;

class SearchPhoneNumbersSearchUserByIdentityRepository implements SearchUserPhoneNumbersRepository
{
    /** @var ApiClient */
    private $client;

    /** @var Serializer */
    private $serializer;

    /** @var ContactInformationToPhoneNumberAdapter */
    private $contactAdapter;

    /** @var string */
    private $apiEndpoint;

    /**
     * @var int $maxResults indicates the maximum
     * of elements it will get to protect the API calls
     */
    private $maxResults = 10;

    public function __construct(
        ApiClient $client,
        Serializer $serializer,
        ContactInformationToPhoneNumberAdapter $contactAdapter,
        string $apiEndpoint
    ) {
        $this->client     = $client;
        $this->serializer = $serializer;
        $this->contactAdapter = $contactAdapter;
        $this->apiEndpoint = $apiEndpoint;
    }

    /**
     * @param int $id
     * @return array
     */
    public function search(int $id) :array
    {
        $body = [
            'limit' => [
                'start' => 0,
                'count' => $this->maxResults,
            ],
            'criteria' => [
                'field' => 'identity_id',
                'operator' => '=',
                'value' => $id,
            ]
        ];

        $apiResponse = $this
            ->client
            ->post($this->apiEndpoint . '/v1/contactinformationidentity/searchby', $body);

        $responseWrapper = $this->serializer->deserialize(
            $apiResponse->getBody()->getContents(),
            ContactInformationSearchResponseWrapper::class,
            'json'
        );

        return $this->contactAdapter->parse($responseWrapper);
    }
}
