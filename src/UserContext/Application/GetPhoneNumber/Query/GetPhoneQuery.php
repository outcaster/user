<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\Shared\Domain\CQRS\Query\Query;

final class GetPhoneQuery implements Query
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
