<?php

declare(strict_types = 1);

namespace App\Shared\Domain\CQRS\Query;

interface QueryHandler
{
    public function __invoke($query);
}
