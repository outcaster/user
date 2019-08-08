<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindPersonByName\Query;

use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\UserContext\Domain\Repository\SearchPersonRepository;

class FindPersonByNameQueryHandler implements QueryHandler
{
    /** @var SearchPersonRepository */
    private $searchPersonRepository;

    /**
     * FindPersonByNameQueryHandler constructor.
     * @param SearchPersonRepository $searchPersonRepository
     */
    public function __construct(SearchPersonRepository $searchPersonRepository)
    {
        $this->searchPersonRepository = $searchPersonRepository;
    }


    public function __invoke(FindPersonByNameQuery $query) :?FindPersonByNameQueryResponse
    {
        return new FindPersonByNameQueryResponse($this->searchPersonRepository->search($query->getName()));
    }
}
