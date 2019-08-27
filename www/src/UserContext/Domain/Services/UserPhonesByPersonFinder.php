<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Domain\Entities\PhonesCollection;
use App\UserContext\Domain\Entities\PersonId;
use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;

class UserPhonesByPersonFinder
{
    /** @var SearchUserPhoneNumbersRepository */
    private $repository;

    /**
     * PersonByNameFinder constructor.
     * @param SearchUserPhoneNumbersRepository $repository
     */
    public function __construct(SearchUserPhoneNumbersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find the user phones by the person
     * @param PersonId $personId
     * @return PersonPhonesCollection|null
     */
    public function find(PersonId $personId) :?PhonesCollection
    {
        return new PhonesCollection(
            $this->repository->search(
                $personId->getValue()
            )
        );
    }
}
