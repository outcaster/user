<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindPersonByName\Query;

use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\UserContext\Domain\Services\PersonByNameFinder;

class FindPersonByNameQueryHandler implements QueryHandler
{
    /** @var PersonByNameFinder */
    private $finder;

    /**
     * FindPersonByNameQueryHandler constructor.
     * @param PersonByNameFinder $finder
     */
    public function __construct(PersonByNameFinder $finder)
    {
        $this->finder = $finder;
    }


    public function __invoke(FindPersonByNameQuery $query) :?FindPersonByNameQueryResponse
    {
        return $this->finder->find($query);
    }
}
