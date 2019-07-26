<?php


namespace App\UserContext\Domain\Entities;


final class ContactInformationType
{
    const PERSONAL_NUMBER = 1;
    const WORK_NUMBER = 2;

    private $contactId;
    private $contactName;

    /**
     * ContactInformationType constructor.
     * @param $contactId
     */
    public function __construct(int $contactId)
    {
        $this->contactId = $contactId;
        switch ($contactId) {
            case self::PERSONAL_NUMBER:
                $this->contactName = 'PersonalNumber';
                break;
            case self::WORK_NUMBER:
                $this->contactName = 'WorkNumber';
                break;
            default:
                throw new \RuntimeException('Unknown contact information id:' . $contactId);
               //TODO: throw new UnknownContactInformationException;

        }
    }

    public function __toString()
    {
        return $this->contactName;
    }


}