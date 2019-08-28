<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Entities;

use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\PersonId;
use App\UserContext\Domain\Entities\PersonName;

final class PersonMother
{
    /**
     * @param PersonId $id
     * @return Person
     */
    static function createPersonWithId(PersonId $id): Person
    {
        $person = new Person(
            $id,
            new PersonName('Connor')
        );

        return $person;
    }
    /**
     * @return Person
     */
    static function createRandomPerson(): Person
    {
        $person = new Person(
            new PersonId(1),
            new PersonName('Connor')
        );

        return $person;
    }
}