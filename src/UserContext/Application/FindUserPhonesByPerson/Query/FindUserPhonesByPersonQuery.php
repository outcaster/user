<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindUserPhonesByPerson\Query;

use App\UserContext\Domain\Entities\Person;

final class FindUserPhonesByPersonQuery
{
    /** @var Person */
    private $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
