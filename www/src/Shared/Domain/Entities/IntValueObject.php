<?php
declare(strict_types = 1);

namespace App\Shared\Domain\Entities;

class IntValueObject
{
    /**
     * @var int
     */
    private $value;

    /**
     * PersonId constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue() :int
    {
        return $this->value;
    }
}
