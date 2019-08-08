<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\CQRS\MessageHandler;

use App\Shared\Domain\CQRS\Query\Response;
use App\Shared\Infrastructure\CQRS\MessageHandler\SymfonyQueryHandler;
use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQuery;
use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQueryHandler;

class SymfonyFindUserPhonesByPersonQueryHandler extends SymfonyQueryHandler
{
    /** @var FindUserPhonesByPersonQueryHandler  */
    protected $handler;

    public function __construct(FindUserPhonesByPersonQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(FindUserPhonesByPersonQuery $query): ?Response
    {
        $handler = $this->handler;
        return $handler($query);
    }
}
