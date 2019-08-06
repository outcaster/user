<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;
use App\UserContext\Infrastructure\Connections\ApiClient;
use App\UserContext\Infrastructure\Serialization\Serializer;
use App\UserContext\Infrastructure\Serialization\Entities\ContactInformationSearchResponseWrapper;
use App\UserContext\Infrastructure\Serialization\Adapter\ContactInformationToPhoneNumberAdapter;

class SearchPhoneNumbersSearchUserByIdentityRepository implements SearchUserPhoneNumbersRepository
{
    private $client;
    private $serializer;
    private $contactAdapter;

    public function __construct(
        ApiClient $client,
        Serializer $serializer,
        ContactInformationToPhoneNumberAdapter $contactAdapter
    ) {
        $this->client     = $client;
        $this->serializer = $serializer;
        $this->contactAdapter = $contactAdapter;
    }

    /**
     * @param int $id
     * @return array
     */
    public function search(int $id) :array
    {

        $apiResponse = $this
            ->client
            ->get('http://localhost/dpm/public/index.php/v1/contactinformation/' . $id);

        $responseWrapper = $this->serializer->deserialize(
            $apiResponse->getBody()->getContents(),
            ContactInformationSearchResponseWrapper::class,
            'json'
        );

        return $this->contactAdapter->parse($responseWrapper);
    }
}
