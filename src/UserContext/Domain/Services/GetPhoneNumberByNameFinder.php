<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQuery;
use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQuery;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQueryResponse;
use App\UserContext\Domain\Entities\ContactInformationAggregateRoot;
use App\UserContext\Domain\Entities\Person;

class GetPhoneNumberByNameFinder
{
    /** @var PersonByNameFinder */
    private $personFinder;

    /** @var UserPhonesByPersonFinder */
    private $userPhonesFinder;

    /**
     * GetPhoneNumberByNameFinder constructor.
     * @param PersonByNameFinder $personFinder
     * @param UserPhonesByPersonFinder $userPhonesFinder
     */
    public function __construct(PersonByNameFinder $personFinder, UserPhonesByPersonFinder $userPhonesFinder)
    {
        $this->personFinder = $personFinder;
        $this->userPhonesFinder = $userPhonesFinder;
    }

    /**
     * Find the persons and related phones for the given query
     *
     * @param GetPhoneQuery $query
     * @return GetPhoneQueryResponse
     */
    public function find(GetPhoneQuery $query) :GetPhoneQueryResponse
    {
        $result = [];
        //1. get the identities
        $people = $this->personFinder->find(new FindPersonByNameQuery($query->getName()));

        //2.foreach identity get the user contact information
        /** @var Person $person */
        foreach ($people as $person) {
            $contactInfoArray = $this->userPhonesFinder->find(new FindUserPhonesByPersonQuery($person));
            //3. build the user telephone object
            $userPhone = new ContactInformationAggregateRoot($person, $contactInfoArray->items());
            $result[] = $userPhone;
        }

        return new GetPhoneQueryResponse($result);
    }
}