<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQueryResponse;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\PersonId;
use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;

class UserPhonesByPersonFinder
{
    /** @var SearchUserPhoneNumbersRepository */
    private $searchPersonRepository;

    /**
     * PersonByNameFinder constructor.
     * @param SearchUserPhoneNumbersRepository $searchPersonRepository
     */
    public function __construct(SearchUserPhoneNumbersRepository $searchPersonRepository)
    {
        $this->searchPersonRepository = $searchPersonRepository;
    }

    /**
     * Find the user phones by the person
     * @param PersonId $personId
     * @return FindUserPhonesByPersonQueryResponse|null
     */
    public function find(PersonId $personId) :?FindUserPhonesByPersonQueryResponse
    {
        return new FindUserPhonesByPersonQueryResponse(
            $this->searchPersonRepository->search(
                $personId->getValue()
            )
        );
    }
}
