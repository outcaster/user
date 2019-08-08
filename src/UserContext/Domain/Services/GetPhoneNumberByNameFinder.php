<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQueryResponse;
use App\UserContext\Domain\Entities\ContactInformationAggregateRoot;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;
use App\UserContext\Domain\Repository\SearchPersonRepository;

class GetPhoneNumberByNameFinder
{
    private $identitySearchByNameRepository;
    private $contactInformationSearchByIdentityRepository;

    public function __construct(
        SearchPersonRepository $identitySearchByNameRepository,
        SearchUserPhoneNumbersRepository $contactInformationSearchByIdentityRepository
    ) {
        $this->identitySearchByNameRepository = $identitySearchByNameRepository;
        $this->contactInformationSearchByIdentityRepository = $contactInformationSearchByIdentityRepository;
    }

    public function find(GetPhoneQuery $query) :GetPhoneQueryResponse
    {
        $result = [];
        //1. get the identities
        $people = $this->identitySearchByNameRepository->search($query->getName());

        //2.foreach identity get the user contact information
        /** @var Person $person */
        foreach ($people as $person) {
            $contactInfoArray = $this->contactInformationSearchByIdentityRepository->search($person->getId());
            //3. build the user telephone object
            $userPhone = new ContactInformationAggregateRoot($person, $contactInfoArray);
            $result[] = $userPhone;
        }

        return new GetPhoneQueryResponse($result);
    }
}
