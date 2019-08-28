<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

use App\UserContext\Domain\Exception\UnknownUserPhoneException;

final class PhoneType
{
    const PERSONAL_NUMBER = 1;
    const WORK_NUMBER = 2;
    const MOBILE_NUMBER = 3;
    const PERSONAL_NUMBER_TEXT = 'PersonalNumber';
    const WORK_NUMBER_TEXT = 'WorkNumber';
    const MOBILE_NUMBER_TEXT = 'MobileNumber';

    const KNOWN_PHONE_TYPES = [
        self::PERSONAL_NUMBER => self::PERSONAL_NUMBER_TEXT,
        self::WORK_NUMBER => self::WORK_NUMBER_TEXT,
        self::MOBILE_NUMBER => self::MOBILE_NUMBER_TEXT,
    ];

    /** @var int */
    private $contactId;

    /** @var string */
    public $contactName;

    /**
     * ContactInformationType constructor.
     * @param $contactId
     */
    public function __construct(int $contactId)
    {
        $this->contactId = $contactId;
        $this->ensureItIsKnownType();
        $this->contactName = self::KNOWN_PHONE_TYPES[$this->contactId];
    }

    /**
     * @throws UnknownUserPhoneException if the user in not a known type
     */
    public function ensureItIsKnownType(): void
    {
        if ($this->contactId < self::PERSONAL_NUMBER ||
            $this->contactId > self::MOBILE_NUMBER) {
                throw new UnknownUserPhoneException('Unknown contact information id:' . $this->contactId);
        }
    }

    /**
     * @return string
     */
    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function __toString(): string
    {
        return $this->contactName;
    }
}
