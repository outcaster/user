<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

use App\Shared\Domain\Query\CollectionResponse;
use App\UserContext\Domain\Entities\Person;

class PersonCollection extends CollectionResponse
{
    protected function type(): string
    {
        return Person::class;
    }
}
