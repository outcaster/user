<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindPersonByName\Query;

use App\Shared\Domain\Query\CollectionResponse;
use App\UserContext\Domain\Entities\Person;

class FindPersonByNameQueryResponse extends CollectionResponse
{
    protected function type(): string
    {
        return Person::class;
    }
}