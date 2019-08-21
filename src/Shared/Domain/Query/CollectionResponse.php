<?php
declare(strict_types = 1);

namespace App\Shared\Domain\Query;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;

abstract class CollectionResponse implements Countable, IteratorAggregate
{
    /** @var array */
    private $items;

    /**
     * @return string class name of the collection type
     */
    abstract protected function type(): string;

    /**
     * CollectionResponse constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        self::arrayOf($this->type(), $items);

        $this->items = $items;
    }

    /**
     * @return array collection items
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * @return ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items());
    }

    /**
     * @return int|void
     */
    public function count() :int
    {
        return count($this->items());
    }

    /**
     * Validate all the types of the selected collection items
     *
     * @param string $class
     * @param array $items
     */
    protected function arrayOf(string $class, array $items): void
    {
        foreach ($items as $item) {
            self::instanceOf($class, $item);
        }
    }

    /**
     * Check if an item is an instance of $class
     *
     * @param $class
     * @param $item
     *
     * @throws InvalidArgumentException if the item is not $class type
     */
    protected function instanceOf(string $class, $item): void
    {
        if (!$item instanceof $class) {
            throw new InvalidArgumentException(
                sprintf('The object <%s> is not an instance of <%s>', $class, get_class($item))
            );
        }
    }
}
