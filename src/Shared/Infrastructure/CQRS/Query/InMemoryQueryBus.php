<?php
declare(strict_types = 1);

namespace App\Shared\Infrastructure\CQRS\Query;

use TypeError;
use App\Shared\Domain\CQRS\Query\Query;
use App\Shared\Domain\CQRS\Query\QueryBus;
use App\Shared\Domain\CQRS\Query\Response;

/**
 * Class InMemoryQueryBus.
 *
 * @package App\Shared\Infrastructure\CQRS\Query
 */
class InMemoryQueryBus implements QueryBus
{

    /** @var array */
    private $handlers;

    /**
     * InMemoryQueryBus constructor.
     * @param array $handlers
     */
    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * Call to first handler able to manage it
     *
     * @param Query $query
     * @return Response|null
     */
    public function ask(Query $query): ?Response
    {
        foreach ($this->handlers as $handler) {
            try {
                return $handler($query);
            } catch (TypeError $exception) {
                // try with another
                continue;
            }
        }
        return null;
    }
}
