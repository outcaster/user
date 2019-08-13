<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQueryResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetPhoneResponseHandler
{
    /**
     * @param GetPhoneQueryResponse $result
     * @return Response
     */
    public function success(GetPhoneQueryResponse $result): Response
    {
        return new JsonResponse($result->items());
    }
}
