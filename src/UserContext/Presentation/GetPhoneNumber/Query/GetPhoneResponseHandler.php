<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQueryResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetPhoneResponseHandler
{
    public function success($result): Response
    {
        return new JsonResponse($result instanceof GetPhoneQueryResponse ? $result->items(): $result);
    }
}
