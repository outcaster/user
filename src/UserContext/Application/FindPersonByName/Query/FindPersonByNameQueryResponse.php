<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindPersonByName\Query;

use App\Shared\Domain\CQRS\Query\Response;
use App\Shared\Infrastructure\CQRS\Query\CollectionResponse;
use App\UserContext\Domain\Entities\Person;

class FindPersonByNameQueryResponse extends CollectionResponse implements Response
{
    protected function type(): string
    {
        return Person::class;
    }
}
