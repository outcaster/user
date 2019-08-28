<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Domain\Entities\PersonPhonesCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetPhoneResponseHandler
{
    /**
     * @param PersonPhonesCollection $result
     * @return Response
     */
    public function success(PersonPhonesCollection $result): Response
    {
        return new JsonResponse($result->items());
    }
}
