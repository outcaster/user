<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Repository;

use App\UserContext\Domain\Entities\ContactInformation;

interface ContactInformationRepository
{

    /**
     * Find a list of contact information by identity id
     *
     * @param int $id
     *
     * @return ContactInformation[]
     */
    public function search(int $id): array;
}
