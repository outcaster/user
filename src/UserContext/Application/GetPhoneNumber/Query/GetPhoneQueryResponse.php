<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\Shared\Infrastructure\CQRS\Query\CollectionResponse;
use App\UserContext\Domain\Entities\ContactInformationAggregateRoot;
use App\Shared\Domain\CQRS\Query\Response;

class GetPhoneQueryResponse extends CollectionResponse implements Response
{
    protected function type(): string
    {
        return ContactInformationAggregateRoot::class;
    }
}
