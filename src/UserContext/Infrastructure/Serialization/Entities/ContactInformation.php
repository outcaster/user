<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

use phpDocumentor\Reflection\Types\Integer;

class ContactInformation
{
    /**
     * @Type("integer")
     * @var int
     */
    private $contactInformationId;

    /**
     * @Type("App\UserContext\Infrastructure\Serialization\Entities\ContactInformationIdentity")
     * @var ContactInformationIdentity $contactInformationIdentity
     */
    private $contactInformationIdentity;

    /**
     * @return int
     */
    public function getContactInformationId() :int
    {
        return $this->contactInformationId;
    }

    /**
     * @param integer $contactInformationId
     * @return ContactInformation
     */
    public function setContactInformationId($contactInformationId): ContactInformation
    {
        $this->contactInformationId = $contactInformationId;
        return $this;
    }

    /**
     * @return ContactInformationIdentity
     */
    public function getContactInformationIdentity(): ContactInformationIdentity
    {
        return $this->contactInformationIdentity;
    }

    /**
     * @param ContactInformationIdentity $contactInformationIdentity
     */
    public function setContactInformationIdentity(ContactInformationIdentity $contactInformationIdentity): void
    {
        $this->contactInformationIdentity = $contactInformationIdentity;
    }
}
