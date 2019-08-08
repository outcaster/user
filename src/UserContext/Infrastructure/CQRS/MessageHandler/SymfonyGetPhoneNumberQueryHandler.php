<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\CQRS\MessageHandler;

use App\Shared\Domain\CQRS\Query\Response;
use App\Shared\Infrastructure\CQRS\MessageHandler\SymfonyQueryHandler;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneNumberQueryHandler;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;

class SymfonyGetPhoneNumberQueryHandler extends SymfonyQueryHandler
{
    /** @var GetPhoneNumberQueryHandler  */
    protected $handler;

    public function __construct(GetPhoneNumberQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(GetPhoneQuery $query): ?Response
    {
        $handler = $this->handler;
        return $handler($query);
    }
}
