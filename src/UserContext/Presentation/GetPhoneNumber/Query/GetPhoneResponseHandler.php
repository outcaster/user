<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Domain\Entities\UserPhoneCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetPhoneResponseHandler
{
    /**
     * @param UserPhoneCollection $result
     * @return Response
     */
    public function success(UserPhoneCollection $result): Response
    {
        return new JsonResponse($result->items());
    }
}
