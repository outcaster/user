<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

final class GetPhoneQuery
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
