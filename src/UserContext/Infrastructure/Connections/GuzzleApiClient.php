<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Connections;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class GuzzleApiClient implements ApiClient
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    function post(string $url, array $body)
    {
        return $apiResponse = $this
            ->client
            ->post(
                $url,
                [
                    RequestOptions::JSON => $body,
                ]
            );
    }

    function get(string $url)
    {
        return $apiResponse = $this->client->get($url);
    }
}
