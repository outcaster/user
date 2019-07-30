<?php


namespace App\UserContext\Infrastructure\Serialization\Entities;


class IdentityDetail
{
    /**
     * @Type("string")
     * @var string
     */
    private $name;

    /**
     * @Type("string")
     * @var string
     */
    private $firstName;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return IdentityDetail
     */
    public function setName(string $name): IdentityDetail
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return IdentityDetail
     */
    public function setFirstName(string $firstName): IdentityDetail
    {
        $this->firstName = $firstName;
        return $this;
    }
}