<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

class UserPhone
{
    /** @var UserPhoneType */
    public $type;

    /** @var string */
    public $phoneNumber;

    /**
     * UserPhone constructor.
     * @param UserPhoneType $type
     * @param string $phoneNumber
     */
    public function __construct(UserPhoneType $type, string $phoneNumber)
    {
        $this->type = $type;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return UserPhoneType
     */
    public function getType(): UserPhoneType
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function __toString()
    {
        return $this->type . ':' . $this->phoneNumber;
    }
}
