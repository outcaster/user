<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindUserPhonesByPerson\Query;

use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;

class FindUserPhonesByPersonQueryHandler implements QueryHandler
{
    /** @var SearchUserPhoneNumbersRepository */
    private $repository;

    /**
     * FindUserPhonesByPersonQueryHandler constructor.
     * @param SearchUserPhoneNumbersRepository $repository
     */
    public function __construct(SearchUserPhoneNumbersRepository $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(FindUserPhonesByPersonQuery $query) :?FindUserPhonesByPersonQueryResponse
    {
        return new FindUserPhonesByPersonQueryResponse($this->repository->search($query->getPerson()->getId()));
    }
}
