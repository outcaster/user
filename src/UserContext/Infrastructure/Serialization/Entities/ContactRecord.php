<?php


namespace App\UserContext\Infrastructure\Serialization\Entities;


class ContactRecord
{
    /**
     * @Type("array<App\UserContext\Infrastructure\Serialization\Entities\ContactDetail>")
     * @var \App\UserContext\Infrastructure\Serialization\Entities\ContactDetail[]
     */
    private $contactDetails;

    /**
     * @return ContactDetail[]
     */
    public function getContactDetails(): array
    {
        return $this->contactDetails;
    }

    /**
     * @param ContactDetail[] $contactDetails
     * @return ContactRecord
     */
    public function setContactDetails(array $contactDetails): ContactRecord
    {
        $this->contactDetails = $contactDetails;
        return $this;
    }
}