<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

final class PersonName
{
    /**
     * @var string
     */
    private $value;

    /**
     * PersonName constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue() :string
    {
        return $this->value;
    }
}
