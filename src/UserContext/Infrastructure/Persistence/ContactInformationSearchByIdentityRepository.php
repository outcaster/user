<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Domain\Entities\Identity;
use App\UserContext\Infrastructure\Connections\ApiClient;

class ContactInformationSearchByIdentityRepository
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

    public function search(string $name)
    {
        die('im in the client');
        

        //return $this->deserializer->deserialize($apiResponse, Identity::class, 'json');
    }
}
