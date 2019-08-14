<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

class ContactInformationIdentity
{
    /**
     * @Type("string")
     * @var string
     */
    private $data;

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return ContactInformationIdentity
     */
    public function setData(string $data): ContactInformationIdentity
    {
        $this->data = $data;
        return $this;
    }
}
