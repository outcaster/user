<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Entities\Identity;
use App\UserContext\Domain\Repository\ContactInformationRepository;
use App\UserContext\Infrastructure\Connections\ApiClient;

class ContactInformationSearchByIdentityRepository implements ContactInformationRepository
{
    private $client;
    private $deserializer;

    public function __construct(
        ApiClient $client
        //$deserializer
    ) {
        $this->client       = $client;
        /*$this->deserializer = $deserializer;*/
    }

    public function search(int $id): array
    {
        // die('im in the client');

        return [];

        //return $this->deserializer->deserialize($apiResponse, Identity::class, 'json');
    }
}
