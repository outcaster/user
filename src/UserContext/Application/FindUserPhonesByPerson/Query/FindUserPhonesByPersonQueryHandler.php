<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindUserPhonesByPerson\Query;

use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\UserContext\Domain\Services\UserPhonesByPersonFinder;

class FindUserPhonesByPersonQueryHandler implements QueryHandler
{
    /** @var UserPhonesByPersonFinder */
    private $finder;

    /**
     * FindUserPhonesByPersonQueryHandler constructor.
     * @param UserPhonesByPersonFinder $finder
     */
    public function __construct(UserPhonesByPersonFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindUserPhonesByPersonQuery $query) :?FindUserPhonesByPersonQueryResponse
    {
        return $this->finder->find($query);
    }
}
