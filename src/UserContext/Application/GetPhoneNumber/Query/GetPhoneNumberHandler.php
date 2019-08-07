<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\Shared\Domain\CQRS\Query\Query;
use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\Shared\Domain\CQRS\Query\Response;
use App\UserContext\Domain\Services\GetPhoneNumberByNameFinder;

class GetPhoneNumberHandler implements QueryHandler
{
    private $getPhoneNumberByNameManager;

    public function __construct(GetPhoneNumberByNameFinder $getPhoneNumberByNameManager)
    {
        $this->getPhoneNumberByNameManager = $getPhoneNumberByNameManager;
    }

    public function __invoke(Query $query) :?Response
    {
        return $this->getPhoneNumberByNameManager->find($query);
    }
}
