<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

final class ContactInformationAggregateRoot
{
    /** @var Person */
    public $person;

    /** @var UserPhone[] */
    private $userPhones;

    /** @var array */
    public $phoneNumbers = [];

    /**
     * ContactInformationAggregateRoot constructor.
     * @param Person $person
     * @param UserPhone[] $userPhones
     */
    public function __construct(Person $person, array $userPhones)
    {
        $this->person = $person;
        $this->userPhones = $userPhones;
        foreach ($userPhones as $userPhone) {
            $this->phoneNumbers[$userPhone->getType()->getContactName()] = $userPhone->getPhoneNumber();
        }
    }
}
