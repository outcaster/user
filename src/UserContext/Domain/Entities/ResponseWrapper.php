<?php


namespace App\UserContext\Domain\Entities;


class ResponseWrapper
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