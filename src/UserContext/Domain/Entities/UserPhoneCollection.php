<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

use App\Shared\Domain\Query\CollectionResponse;

class UserPhoneCollection extends CollectionResponse
{
    protected function type(): string
    {
        return ContactInformationAggregateRoot::class;
    }
}
