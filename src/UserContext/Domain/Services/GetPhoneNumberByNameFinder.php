<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Domain\Entities\ContactInformationAggregateRoot;
use App\UserContext\Domain\Entities\UserPhoneCollection;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\PersonName;

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
     * @param PersonName $name
     * @return UserPhoneCollection
     */
    public function find(PersonName $name) :UserPhoneCollection
    {
        $result = [];
        //1. get the identities
        $people = $this->personFinder->find($name);

        //2.foreach identity get the user contact information
        /** @var Person $person */
        foreach ($people as $person) {
            $contactInfoArray = $this->userPhonesFinder->find($person->getId());
            //3. build the user telephone object
            $userPhone = new ContactInformationAggregateRoot($person, $contactInfoArray->items());
            $result[] = $userPhone;
        }

        return new UserPhoneCollection($result);
    }
}
