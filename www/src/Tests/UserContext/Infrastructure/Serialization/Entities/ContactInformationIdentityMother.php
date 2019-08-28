<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Infrastructure\Serialization\Entities;


use App\UserContext\Infrastructure\Serialization\Entities\ContactInformationIdentity;
use Faker\Factory;

class ContactInformationIdentityMother
{
    /**
     * @return ContactInformationIdentity
     */
    public static function create() :ContactInformationIdentity
    {
        $faker = Factory::create();

        $info = new ContactInformationIdentity();
        $info->setData($faker->phoneNumber());

        return $info;
    }
    /**
     * @return ContactInformationIdentity
     */
    public static function random() :ContactInformationIdentity
    {
        return self::create();
    }
}
