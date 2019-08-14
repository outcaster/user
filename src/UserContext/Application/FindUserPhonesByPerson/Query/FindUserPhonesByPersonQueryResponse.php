<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindUserPhonesByPerson\Query;

use App\Shared\Domain\Query\CollectionResponse;
use App\UserContext\Domain\Entities\UserPhone;

class FindUserPhonesByPersonQueryResponse extends CollectionResponse
{
    protected function type(): string
    {
        return UserPhone::class;
    }
}
