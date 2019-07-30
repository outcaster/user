<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

use phpDocumentor\Reflection\Types\Integer;

class ContactInformation
{
    /**
     * @Type("integer")
     */
    private $contactInformationId;

    /**
     * @Type("App\UserContext\Infrastructure\Serialization\Entities\ContactDetail")
     * @var ContactDetail
     */
    private $contactDetail;

    /**
     * @return mixed
     */
    public function getContactInformationId()
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
     * @return ContactDetail
     */
    public function getContactDetail(): ContactDetail
    {
        return $this->contactDetail;
    }

    /**
     * @param ContactDetail $contactDetail
     * @return ContactInformation
     */
    public function setContactDetail(ContactDetail $contactDetail): ContactInformation
    {
        $this->contactDetail = $contactDetail;
        return $this;
    }
}