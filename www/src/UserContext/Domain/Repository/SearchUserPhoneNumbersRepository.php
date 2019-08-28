<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Repository;

use App\UserContext\Domain\Entities\Phone;

interface SearchUserPhoneNumbersRepository
{

    /**
     * Find a list of phone numbers by person id
     *
     * @param int $id
     *
     * @return Phone[]
     */
    public function search(int $id): array;
}
