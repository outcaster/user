<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

class ContactInformationSearchResponseWrapper
{
    /**
     * @var  \App\UserContext\Infrastructure\Serialization\Entities\ContactInformation[][]
     * @Type("array<App\UserContext\Infrastructure\Serialization\Entities\ContactInformation>")
     */
    private $results;

    public function getResults() :array
    {
        return $this->results;
    }

    /**
     * @param  \App\UserContext\Infrastructure\Serialization\Entities\ContactInformation[][] $results
     * @return void
     */
    public function setResults(array $results) :void
    {
        $this->results = $results;
    }
}
