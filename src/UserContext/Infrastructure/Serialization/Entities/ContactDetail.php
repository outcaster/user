<?php


namespace App\UserContext\Infrastructure\Serialization\Entities;


class ContactDetail
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
     * @return ContactDetail
     */
    public function setData(string $data): ContactDetail
    {
        $this->data = $data;
        return $this;
    }
}