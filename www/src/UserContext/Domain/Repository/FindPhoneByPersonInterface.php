<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Repository;

use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\Phone;

interface FindPhoneByPersonInterface
{

    /**
     * Find a list of phone numbers by person id
     *
     * @param Person $person
     *
     * @return Phone[]
     */
    public function search(Person $person): array;
}
