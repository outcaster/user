<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\UserContext\Domain\Entities\PersonCollection;
use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Repository\FindPersonByNameInterface;

class PersonByNameFinder
{
    /** @var FindPersonByNameInterface */
    private $searchPersonRepository;

    /**
     * PersonByNameFinder constructor.
     * @param FindPersonByNameInterface $searchPersonRepository
     */
    public function __construct(FindPersonByNameInterface $searchPersonRepository)
    {
        $this->searchPersonRepository = $searchPersonRepository;
    }

    /**
     * Find the person with the given name
     * @param PersonName $name
     * @return PersonCollection|null
     */
    public function find(PersonName $name) :?PersonCollection
    {
        return new PersonCollection($this->searchPersonRepository->search($name->getValue()));
    }
}
