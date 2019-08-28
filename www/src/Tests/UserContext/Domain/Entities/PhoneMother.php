<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Entities;

use App\UserContext\Domain\Entities\Phone;
use App\UserContext\Domain\Entities\PhoneNumber;
use App\UserContext\Domain\Entities\PhoneType;

final class PhoneMother
{
    static function createRandomNumber(): Phone
    {
        $type = random_int(PhoneType::PERSONAL_NUMBER, PhoneType::MOBILE_NUMBER);
        $number = random_int(0, 999999999).'';
        return new Phone(new PhoneType($type), new PhoneNumber($number));
    }
    static function createRandomPersonalNumber(): Phone
    {
        $number = random_int(0, 999999999).'';
        return new Phone(new PhoneType(PhoneType::PERSONAL_NUMBER), new PhoneNumber($number));
    }
    static function createRandomWorkNumber(): Phone
    {
        $number = random_int(0, 999999999).'';
        return new Phone(new PhoneType(PhoneType::WORK_NUMBER), new PhoneNumber($number));
    }
    static function createRandomMobileNumber(): Phone
    {
        $number = random_int(0, 999999999).'';
        return new Phone(new PhoneType(PhoneType::MOBILE_NUMBER), new PhoneNumber($number));
    }
}
