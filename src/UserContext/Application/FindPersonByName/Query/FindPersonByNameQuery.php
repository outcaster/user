<?php
declare(strict_types = 1);

namespace App\UserContext\Application\FindPersonByName\Query;

final class FindPersonByNameQuery
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
