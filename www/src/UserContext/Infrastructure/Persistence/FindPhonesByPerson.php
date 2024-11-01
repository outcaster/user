<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Entities\PersonId;
use App\UserContext\Domain\Repository\FindPhoneByPersonInterface;
use App\UserContext\Domain\Entities\Phone;
use App\UserContext\Infrastructure\Connections\ApiClient;
use App\UserContext\Infrastructure\Serialization\DeserializerInterface;
use App\UserContext\Infrastructure\Serialization\Entities\ContactInformationSearchResponseWrapper;
use App\UserContext\Infrastructure\Serialization\Adapter\ContactInformationToPhoneNumberAdapter;

class FindPhonesByPerson implements FindPhoneByPersonInterface
{
    /** @var ApiClient */
    private $client;

    /** @var DeserializerInterface */
    private $deserializer;

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
        DeserializerInterface $deserializer,
        ContactInformationToPhoneNumberAdapter $contactAdapter,
        string $apiEndpoint
    ) {
        $this->client     = $client;
        $this->deserializer = $deserializer;
        $this->contactAdapter = $contactAdapter;
        $this->apiEndpoint = $apiEndpoint;
    }

    /**
     * @param PersonId $personId
     * @return Phone[]
     */
    public function search(PersonId $personId) :array
    {
        $body = [
            'limit' => [
                'start' => 0,
                'count' => $this->maxResults,
            ],
            'criteria' => [
                'field' => 'identity_id',
                'operator' => '=',
                'value' => $personId->getValue(),
            ]
        ];

        $apiResponse = $this
            ->client
            ->post($this->apiEndpoint . '/v1/contactinformationidentity/searchby', $body);

        /** @var ContactInformationSearchResponseWrapper $responseWrapper */
        $responseWrapper = $this->deserializer->deserialize(
            $apiResponse->getBody()->getContents(),
            ContactInformationSearchResponseWrapper::class,
            'json'
        );

        return $this->contactAdapter->parse($responseWrapper);
    }
}
