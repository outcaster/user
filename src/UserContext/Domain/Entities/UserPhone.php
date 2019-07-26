<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

class UserPhone
{
    public $identity;
    public $phoneNumbers;

    /**
     * UserPhone constructor.
     * @param $identity
     * @param $phoneNumbers
     */
    public function __construct($identity, $phoneNumbers)
    {
        $this->identity = $identity;
        $this->phoneNumbers = $phoneNumbers;
        // TODO: Domain exceptions
    }
}
