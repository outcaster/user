<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

class IdentityDetail
{
    /**
     * @Type("string")
     * @Nullable
     * @var string|null
     */
    private $name;

    /**
     * @Type("string")
     * @Nullable
     * @var string|null
     */
    private $firstName;

    /**
     * @return string|null
     */
    public function getName(): ?string
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
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return IdentityDetail
     */
    public function setFirstName(?string $firstName): IdentityDetail
    {
        $this->firstName = $firstName;
        return $this;
    }
}
