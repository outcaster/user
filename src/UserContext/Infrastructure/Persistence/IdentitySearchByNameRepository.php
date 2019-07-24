<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Persistence;

use App\UserContext\Infrastructure\Connections\ApiClient;

class IdentitySearchByNameRepository
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
        $body = [
            'criteria' => [
                'and' => [
                    'field' => 'name',
                    'operator' => '=',
                    'value' => $name,
                ]
            ]
        ];

        $apiResponse = $this
            ->client
            ->request($body);

        die(var_dump($apiResponse));

        //return $this->deserializer->deserialize($apiResponse, Identity::class, 'json');
    }
}
