<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Domain\Entities\UserPhone;
use App\UserContext\Infrastructure\Persistence\ContactInformationSearchByIdentityRepository;
use App\UserContext\Infrastructure\Persistence\IdentitySearchByNameRepository;

class GetPhoneNumberByNameManager
{
    private $identitySearchByNameRepository;
    private $contactInformationSearchByIdentityRepository;

    public function __construct(
        IdentitySearchByNameRepository $identitySearchByNameRepository,
        ContactInformationSearchByIdentityRepository $contactInformationSearchByIdentityRepository
    ) {
        $this->identitySearchByNameRepository = $identitySearchByNameRepository;
        $this->contactInformationSearchByIdentityRepository = $contactInformationSearchByIdentityRepository;
    }

    public function find(GetPhoneQuery $query) :array
    {
        $result = [];
        //1. get the identities
        $identities = $this->identitySearchByNameRepository->search($query->getName());
        die(var_dump($identities));

        //2.foreach identity get the user contact information
        foreach ($identities as $identity) {
            $contactInfoArray = $this->contactInformationSearchByIdentityRepository->search($identity->getId());
            //3. build the user telephone object
            /*$userPhone = new UserPhone($identity, $contactInfoArray);
            $result[] = $userPhone;*/
        }

        return $result;
    }
}
