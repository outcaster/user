<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Repository;

use App\UserContext\Domain\Entities\IdentitySearchResponseWrapper;

interface IdentityRepository
{

    /**
     * Find a list of identities by name
     *
     * @param string $name
     * @return IdentitySearchResponseWrapper
     */
    public function search(string $name): IdentitySearchResponseWrapper;
}
