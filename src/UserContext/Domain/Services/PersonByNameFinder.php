<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQueryResponse;
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
     * @param string $name
     * @return FindPersonByNameQueryResponse|null
     */
    public function find(string $name) :?FindPersonByNameQueryResponse
    {
        return new FindPersonByNameQueryResponse($this->searchPersonRepository->search($name));
    }
}
