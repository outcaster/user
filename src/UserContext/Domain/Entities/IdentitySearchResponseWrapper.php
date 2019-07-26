<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

/**
 * Class ResponseWrapper
 * It contains a list of Identities in $results
 *
 * @package App\UserContext\Domain\Entities
 */
class IdentitySearchResponseWrapper
{
    /**
     * @var  \App\UserContext\Domain\Entities\Identity[]
     * @Type("array<App\UserContext\Domain\Entities\Identity>")
     */
    private $results;

    public function getResults() :array
    {
        return $this->results;
    }

    /**
     * @param  \App\UserContext\Domain\Entities\Identity[] $results
     * @return void
     */
    public function setResults(array $results) :void
    {
        $this->results = $results;
    }
}
