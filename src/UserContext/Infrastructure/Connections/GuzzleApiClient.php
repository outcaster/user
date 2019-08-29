<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Connections;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Component\HttpFoundation\Request;

class GuzzleApiClient implements ApiClient
{
    /** @var Client  */
    private $client;

    /** @var bool  */
    private $isAuthByPassActive = true;

    /** @var string */
    private $auth;

    /** @var array */
    private $byPassHeaders = [
        'X-TENANT-ID',
        'fingerprint',
    ];

    /** @var array */
    private $forcedHeaders = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

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
                    RequestOptions::AUTH => $this->getAuth(),
                    RequestOptions::HEADERS => $this->getHeaders(),
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
        return $apiResponse = $this->client->get($url, [
            RequestOptions::AUTH => $this->getAuth(),
            RequestOptions::HEADERS => $this->getHeaders(),
        ]);
    }

    /**
     * Get the auth setup for the request
     *
     * @return mixed
     */
    protected function getAuth()
    {
        $auth = ('' !== $this->auth) ? $this->auth : null;
        // get token from current request. TODO: is that correct?
        if ($this->isAuthByPassActive) {
            $header = null;
            if (function_exists('apache_request_headers')) {
                $all = apache_request_headers(); // TODO: what happen for others?
                if (isset($all['Authorization'])) {
                    $header = $all['Authorization'];
                }
            }
            $auth = $header;
        }
        return $auth;
    }

    /**
     * Get request headers for the request
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        $headers = [];
        // 1. parse the given from the request
        /** @var Request $request */
        $request = $GLOBALS['request'];
        foreach ($this->byPassHeaders as $header) {
            $headers[$header] = $request->headers->get($header);
        }
        //2. override forced headers
        foreach ($this->forcedHeaders as $headerKey => $headerValue) {
            $headers[$headerKey] = $headerValue;
        }
        return $headers;
    }
}
