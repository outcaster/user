<?php
declare(strict_types = 1);

namespace App\Shared\Infrastructure\CQRS\Query;

use Exception;
use App\Shared\Domain\CQRS\Query\Query;
use App\Shared\Domain\CQRS\Query\QueryBus;
use App\Shared\Domain\CQRS\Query\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class SymfonyQueryBus implements QueryBus
{

    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * SymfonyQueryBus constructor.
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * Ask to the bus the selected query
     *
     * @param Query $query
     * @return Response|null
     */
    public function ask(Query $query): ?Response
    {
        try {
            $response = $this->bus->dispatch($query);
            if ($response instanceof  Envelope) {
                // TODO: refactor this code when use async bus
                return $response->last(HandledStamp::class)->getResult();
            }
            if ($response != null && !($response instanceof Response)) {
                // TODO: Use a domain exception
                throw new \RuntimeException('Unexpected response type');
            }
        } catch (Exception $e) {
            // TODO: use a logger to add this error
            $response = null;
        }
        return $response;
    }
}
