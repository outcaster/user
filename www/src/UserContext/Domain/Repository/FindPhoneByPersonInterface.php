<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Repository;

use App\UserContext\Domain\Entities\PersonId;
use App\UserContext\Domain\Entities\Phone;

interface FindPhoneByPersonInterface
{

    /**
     * Find a list of phone numbers by person id
     *
     * @param PersonId $personId
     *
     * @return Phone[]
     */
    public function search(PersonId $personId): array;
}
