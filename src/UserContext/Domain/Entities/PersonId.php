<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

final class PersonId
{
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
