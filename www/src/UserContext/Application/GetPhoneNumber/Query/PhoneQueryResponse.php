<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

final class PhoneQueryResponse
{
    /**
     * @var array
     */
    private $personPhones;

    public function __construct(array $personPhones)
    {
        $this->personPhones = $personPhones;
    }

    /**
     * @return array
     */
    public function getPersonPhones(): array
    {
        return $this->personPhones;
    }
}
