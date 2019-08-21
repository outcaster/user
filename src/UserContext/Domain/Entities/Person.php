<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

class Person
{
    /**
     * @var PersonId
     */
    public $id;

    /**
     * @var PersonName
     */
    public $name;

    /**
     * Person constructor.
     *
     * @param PersonId $id
     * @param PersonName $name
     */
    public function __construct(PersonId $id, PersonName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return PersonId
     */
    public function getId(): PersonId
    {
        return $this->id;
    }

    /**
     * @return PersonName
     */
    public function getName(): PersonName
    {
        return $this->name;
    }
}
