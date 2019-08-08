<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\CQRS\MessageHandler;

use App\Shared\Domain\CQRS\Query\Response;
use App\Shared\Infrastructure\CQRS\MessageHandler\SymfonyQueryHandler;
use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQuery;
use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQueryHandler;

class SymfonyFindPersonByNameQueryHandler extends SymfonyQueryHandler
{
    /** @var FindPersonByNameQueryHandler  */
    protected $handler;

    public function __construct(FindPersonByNameQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(FindPersonByNameQuery $query): ?Response
    {
        $handler = $this->handler;
        return $handler($query);
    }
}
