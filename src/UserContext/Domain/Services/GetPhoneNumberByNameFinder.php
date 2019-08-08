<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Services;

use App\Shared\Domain\CQRS\Query\QueryBus;
use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQuery;
use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQuery;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQueryResponse;
use App\UserContext\Domain\Entities\ContactInformationAggregateRoot;
use App\UserContext\Domain\Entities\Person;

class GetPhoneNumberByNameFinder
{
    private $queryBus;

    public function __construct(
        QueryBus $queryBus
    ) {
        $this->queryBus = $queryBus;
    }

    public function find(GetPhoneQuery $query) :GetPhoneQueryResponse
    {
        $result = [];
        //1. get the identities
        $people = $this->queryBus->ask(new FindPersonByNameQuery($query->getName()));

        //2.foreach identity get the user contact information
        /** @var Person $person */
        foreach ($people as $person) {
            $contactInfoArray = $this->queryBus->ask(new FindUserPhonesByPersonQuery($person));
            //3. build the user telephone object
            $userPhone = new ContactInformationAggregateRoot($person, $contactInfoArray->items());
            $result[] = $userPhone;
        }

        return new GetPhoneQueryResponse($result);
    }
}
