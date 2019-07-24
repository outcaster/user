<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Connections;

use GuzzleHttp\Client;

class GuzzleApiClient implements ApiClient
{
    private $client;

    public function __construct(string $url = null, string $method = null)
    {
        //$this->client = new Client($url, $method);
    }

    function request(array $body)
    {
        // TODO: Implement request() method.
    }
}
