<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Connections;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class GuzzleApiClient implements ApiClient
{
    /** @var Client  */
    private $client;

    /**
     * GuzzleApiClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @param array $body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $url, array $body)
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

    /**
     * @param string $url
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $url)
    {
        return $apiResponse = $this->client->get($url);
    }
}
