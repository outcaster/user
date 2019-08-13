<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Connections;

interface ApiClient
{
    /**
     * @param string $url
     * @param array $body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $url, array $body);

    /**
     * @param string $url
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $url);
}
