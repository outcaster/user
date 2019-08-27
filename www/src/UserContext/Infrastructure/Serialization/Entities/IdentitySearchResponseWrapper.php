<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

/**
 * Class ResponseWrapper
 * It contains a list of Identities in $results
 *
 * @package App\UserContext\Infrastructure\Serialization\Entities
 */
class IdentitySearchResponseWrapper
{
    /**
     * @var  \App\UserContext\Infrastructure\Serialization\Entities\Identity[]
     * @Type("array<App\UserContext\Infrastructure\Serialization\Entities\Identity>")
     */
    private $results;

    public function getResults() :array
    {
        return $this->results;
    }

    /**
     * @param  \App\UserContext\Infrastructure\Serialization\Entities\Identity[] $results
     * @return void
     */
    public function setResults(array $results) :void
    {
        $this->results = $results;
    }
}
