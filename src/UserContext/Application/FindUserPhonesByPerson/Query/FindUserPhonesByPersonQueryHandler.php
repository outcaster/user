<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindUserPhonesByPerson\Query;

use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\UserContext\Infrastructure\Persistence\SearchPhoneNumbersSearchUserByIdentityRepository;

class FindUserPhonesByPersonQueryHandler implements QueryHandler
{
    /** @var SearchPhoneNumbersSearchUserByIdentityRepository */
    private $repository;

    /**
     * FindUserPhonesByPersonQueryHandler constructor.
     * @param SearchPhoneNumbersSearchUserByIdentityRepository $repository
     */
    public function __construct(SearchPhoneNumbersSearchUserByIdentityRepository $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(FindUserPhonesByPersonQuery $query) :?FindUserPhonesByPersonQueryResponse
    {
        return new FindUserPhonesByPersonQueryResponse($this->repository->search($query->getPerson()->getId()));
    }
}
