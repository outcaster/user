<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Connections;

interface ApiClient
{
    function post(string $url, array $body);
}
