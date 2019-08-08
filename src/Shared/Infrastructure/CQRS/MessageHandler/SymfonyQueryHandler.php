<?php
declare(strict_types = 1);

namespace App\Shared\Infrastructure\CQRS\MessageHandler;

use App\Shared\Domain\CQRS\Query\Query;
use App\Shared\Domain\CQRS\Query\QueryHandler;
use App\Shared\Domain\CQRS\Query\Response;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

abstract class SymfonyQueryHandler implements MessageHandlerInterface
{
}
