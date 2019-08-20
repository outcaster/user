<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

final class PersonName
{
    private $value;

    /**
     * PersonName constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
