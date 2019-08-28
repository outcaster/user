<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class PersonPhone extends AggregateRoot
{
    const PERSON_ID   = 'id';
    const PERSON_NAME = 'name';

    /** @var Person */
    private $person;

    /** @var Phone[] */
    private $userPhones;

    /** @var array */
    public $personInfo = [];

    /** @var array */
    public $phoneNumbers = [];

    /**
     * ContactInformationAggregateRoot constructor.
     * @param Person $person
     * @param Phone[] $userPhones
     */
    public function __construct(Person $person, array $userPhones)
    {
        $this->person = $person;
        $this->userPhones = $userPhones;
        $this->buildPhoneNumbers();
        $this->buildPersonInfo();
    }

    /**
     * Build $this->phoneNumbers array
     */
    protected function buildPhoneNumbers(): void
    {
        foreach ($this->userPhones as $userPhone) {
            $this->phoneNumbers[$userPhone->getType()->getContactName()] = $userPhone->getPhoneNumber()->getValue();
        }
    }

    /**
     * Build $this->phoneNumbers array
     */
    protected function buildPersonInfo(): void
    {
        $person = $this->person;

        $this->personInfo = [
            self::PERSON_ID => $person->getId()->getValue(),
            self::PERSON_NAME => $person->getName()->getValue(),
        ];
    }
}
