<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

final class GetPhoneQuery
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
