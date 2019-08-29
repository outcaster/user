<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

use App\Shared\Domain\Aggregate\AggregateRoot;

class Phone extends AggregateRoot
{
    /** @var PhoneType */
    public $type;

    /** @var PhoneNumber */
    public $phoneNumber;

    /**
     * Phone constructor.
     * @param PhoneType $type
     * @param PhoneNumber $phoneNumber
     */
    public function __construct(PhoneType $type, PhoneNumber $phoneNumber)
    {
        $this->type = $type;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return PhoneType
     */
    public function getType(): PhoneType
    {
        return $this->type;
    }

    /**
     * @return PhoneNumber
     */
    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function __toString()
    {
        return $this->type->getContactName() . ':' . $this->phoneNumber->getValue();
    }
}
