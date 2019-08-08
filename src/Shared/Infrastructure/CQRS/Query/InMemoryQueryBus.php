<?php
declare(strict_types = 1);

namespace App\Shared\Infrastructure\CQRS\Query;

use App\Shared\Domain\CQRS\Query\Query;
use App\Shared\Domain\CQRS\Query\QueryBus;
use App\Shared\Domain\CQRS\Query\Response;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneNumberQueryHandler;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;

/**
 * Class InMemoryQueryBus. TODO: Is this class needed? if is not, delete it
 *
 * @package App\Shared\Infrastructure\CQRS\Query
 */
class InMemoryQueryBus implements QueryBus
{
    /** @var GetPhoneNumberQueryHandler */
    private $getPhoneQueryHandler;

    /**
     * InMemoryQueryBus constructor.
     * @param GetPhoneNumberQueryHandler $getPhoneQueryHandler
     */
    public function __construct(GetPhoneNumberQueryHandler $getPhoneQueryHandler)
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
