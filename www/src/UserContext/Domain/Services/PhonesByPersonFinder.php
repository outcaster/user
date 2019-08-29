<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Domain\Entities\PersonId;
use App\UserContext\Domain\Entities\PhonesCollection;
use App\UserContext\Domain\Repository\FindPhoneByPersonInterface;

class PhonesByPersonFinder
{
    /** @var FindPhoneByPersonInterface */
    private $repository;

    /**
     * PersonByNameFinder constructor.
     * @param FindPhoneByPersonInterface $repository
     */
    public function __construct(FindPhoneByPersonInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find the user phones by the person
     * @param PersonId $personId
     * @return PhonesCollection|null
     */
    public function find(PersonId $personId) :?PhonesCollection
    {
        return new PhonesCollection(
            $this->repository->search(
                $personId
            )
        );
    }
}
