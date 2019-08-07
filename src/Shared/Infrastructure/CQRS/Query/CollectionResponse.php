<?php
declare(strict_types = 1);

namespace App\Shared\Infrastructure\CQRS\Query;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;

abstract class CollectionResponse implements Countable, IteratorAggregate
{
    /** @var array */
    private $items;

    public function __construct(array $items)
    {
        self::arrayOf($this->type(), $items);

        $this->items = $items;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items());
    }

    public function count()
    {
        return count($this->items());
    }

    public function items()
    {
        return $this->items;
    }
    abstract protected function type(): string;

    protected function arrayOf(string $class, array $items): void
    {
        foreach ($items as $item) {
            self::instanceOf($class, $item);
        }
    }

    protected function instanceOf($class, $item): void
    {
        if (!$item instanceof $class) {
            throw new InvalidArgumentException(
                sprintf('The object <%s> is not an instance of <%s>', $class, get_class($item))
            );
        }
    }
}
