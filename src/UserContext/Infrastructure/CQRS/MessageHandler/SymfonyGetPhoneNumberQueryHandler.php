<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\CQRS\MessageHandler;

use App\Shared\Infrastructure\CQRS\MessageHandler\SymfonyQueryHandler;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneNumberQueryHandler;

class SymfonyGetPhoneNumberQueryHandler extends SymfonyQueryHandler
{
    public function __construct(GetPhoneNumberQueryHandler $handler)
    {
        $this->handler = $handler;
    }
}
