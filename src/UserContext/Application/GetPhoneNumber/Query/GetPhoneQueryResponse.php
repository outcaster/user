<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\Shared\Domain\Query\CollectionResponse;
use App\UserContext\Domain\Entities\ContactInformationAggregateRoot;

class GetPhoneQueryResponse extends CollectionResponse
{
    protected function type(): string
    {
        return ContactInformationAggregateRoot::class;
    }
}
