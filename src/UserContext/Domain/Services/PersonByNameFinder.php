<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQueryResponse;
use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Repository\SearchPersonRepository;

class PersonByNameFinder
{
    /** @var SearchPersonRepository */
    private $searchPersonRepository;

    /**
     * PersonByNameFinder constructor.
     * @param SearchPersonRepository $searchPersonRepository
     */
    public function __construct(SearchPersonRepository $searchPersonRepository)
    {
        $this->searchPersonRepository = $searchPersonRepository;
    }

    /**
     * Find the person with the given name
     * @param PersonName $name
     * @return FindPersonByNameQueryResponse|null
     */
    public function find(PersonName $name) :?FindPersonByNameQueryResponse
    {
        return new FindPersonByNameQueryResponse($this->searchPersonRepository->search($name->getValue()));
    }
}
