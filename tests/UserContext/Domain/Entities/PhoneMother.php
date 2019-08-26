<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Entities;

use App\UserContext\Domain\Entities\Phone;
use App\UserContext\Domain\Entities\PhoneNumber;
use App\UserContext\Domain\Entities\PhoneType;

final class PhoneMother
{
    /**
     * @param PhoneNumber $number
     * @return Phone
     */
    static function createPersonalNumber(PhoneNumber $number): Phone
    {
        return new Phone(new PhoneType(PhoneType::PERSONAL_NUMBER), $number);
    }
    /**
     * @return Phone
     */
    static function createRandomPersonalNumber(): Phone
    {
        return self::createPersonalNumber(new PhoneNumber('6666666'));
    }
    /**
     * @return Phone
     */
    static function createRandomNumber(): Phone
    {
        $type = PhoneType::PERSONAL_NUMBER;
        $number = '66666666';
        return new Phone(new PhoneType($type), new PhoneNumber($number));
    }
}