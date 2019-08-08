<?php
declare(strict_types = 1);

namespace App\Shared\Infrastructure\CQRS\MessageHandler;

use App\Shared\Domain\CQRS\Query\Query;
use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\Shared\Domain\CQRS\Query\Response;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SymfonyQueryHandler implements MessageHandlerInterface
{
    protected $handler;

    public function __construct(QueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Query $query) :?Response
    {
        $handler = $this->handler;
        return $handler($query);
    }
}
