<?php
declare(strict_types = 1);

namespace App\Shared\Infrastructure\CQRS\Query;

use App\Shared\Domain\CQRS\Query\Query;
use App\Shared\Domain\CQRS\Query\QueryBus;
use App\Shared\Domain\CQRS\Query\Response;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneNumberHandler;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;

class InMemoryQueryBus implements QueryBus
{
    /** @var GetPhoneNumberHandler */
    private $getPhoneQueryHandler;

    /**
     * InMemoryQueryBus constructor.
     * @param GetPhoneNumberHandler $getPhoneQueryHandler
     */
    public function __construct(GetPhoneNumberHandler $getPhoneQueryHandler)
    {
        $this->getPhoneQueryHandler = $getPhoneQueryHandler;
    }

    /**
     * TODO: doc
     * @param Query $query
     * @return Response|null
     */
    public function ask(Query $query): ?Response
    {
        $handler = $this->getPhoneQueryHandler;

        if ($query instanceof GetPhoneQuery) {
            return $handler($query);
        } else {
            return null;
        }
    }
}
