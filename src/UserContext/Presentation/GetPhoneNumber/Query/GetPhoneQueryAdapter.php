<?php
declare(strict_types = 1);

namespace App\UserContext\Presentation\GetPhoneNumber\Query;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;

class GetPhoneQueryAdapter
{
    public function getQueryFromRequest(string $name) :GetPhoneQuery
    {
        return new GetPhoneQuery($name);
    }
}
