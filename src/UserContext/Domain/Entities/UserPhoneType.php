<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

use App\UserContext\Domain\Exception\UnknownUserPhoneException;

final class UserPhoneType
{
    const PERSONAL_NUMBER = 1;
    const WORK_NUMBER = 2;
    const MOBILE_NUMBER = 3;
    const PERSONAL_NUMBER_TEXT = 'PersonalNumber';
    const WORK_NUMBER_TEXT = 'WorkNumber';
    const MOBILE_NUMBER_TEXT = 'MobileNumber';

    private $contactId;
    public $contactName;

    /**
     * ContactInformationType constructor.
     * @param $contactId
     */
    public function __construct(int $contactId)
    {
        $this->contactId = $contactId;
        switch ($contactId) {
            case self::PERSONAL_NUMBER:
                $this->contactName = self::PERSONAL_NUMBER_TEXT;
                break;
            case self::WORK_NUMBER:
                $this->contactName = self::WORK_NUMBER_TEXT;
                break;
            case self::MOBILE_NUMBER:
                $this->contactName = self::MOBILE_NUMBER_TEXT;
                break;
            default:
                throw new UnknownUserPhoneException('Unknown contact information id:' . $contactId);
        }
    }

    /**
     * @return string
     */
    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function __toString()
    {
        return $this->contactName;
    }
}
