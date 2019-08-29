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

    /**
     * ContactInformationAggregateRoot constructor.
     * @param Person $person
     * @param Phone[] $userPhones
     */
    public function __construct(Person $person, array $userPhones)
    {
        $this->person = $person;
        $this->userPhones = $userPhones;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return Phone[]
     */
    public function getUserPhones(): array
    {
        return $this->userPhones;
    }
}
