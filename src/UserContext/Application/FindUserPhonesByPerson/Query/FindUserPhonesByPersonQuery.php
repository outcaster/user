<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindUserPhonesByPerson\Query;

use App\Shared\Domain\CQRS\Query\Query;
use App\UserContext\Domain\Entities\Person;

final class FindUserPhonesByPersonQuery implements Query
{
    /** @var Person */
    private $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    public function getPerson()
    {
        return $this->person;
    }
}
