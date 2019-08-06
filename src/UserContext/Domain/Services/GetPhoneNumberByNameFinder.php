<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Domain\Entities\ContactInformationAggregateRoot;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Repository\ContactInformationRepository;
use App\UserContext\Domain\Repository\IdentityRepository;

class GetPhoneNumberByNameFinder
{
    private $identitySearchByNameRepository;
    private $contactInformationSearchByIdentityRepository;

    public function __construct(
        IdentityRepository $identitySearchByNameRepository,
        ContactInformationRepository $contactInformationSearchByIdentityRepository
    ) {
        $this->identitySearchByNameRepository = $identitySearchByNameRepository;
        $this->contactInformationSearchByIdentityRepository = $contactInformationSearchByIdentityRepository;
    }

    public function find(GetPhoneQuery $query) :array
    {
        $result = [];
        //1. get the identities
        $people = $this->identitySearchByNameRepository->search($query->getName());
        //die(var_dump($identities));

        //2.foreach identity get the user contact information
        /** @var Person $person */
        foreach ($people as $person) {
            $contactInfoArray = $this->contactInformationSearchByIdentityRepository->search($person->getId());
            //3. build the user telephone object
            $userPhone = new ContactInformationAggregateRoot($person, $contactInfoArray);
            $result[] = $userPhone;
        }

        return $result;
    }
}
