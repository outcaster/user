<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Repository;

use App\UserContext\Domain\Entities\Person;

interface FindPersonByNameInterface
{

    /**
     * Find a list of identities by name
     *
     * @param string $name
     * @return Person[]
     */
    public function search(string $name): array;
}
