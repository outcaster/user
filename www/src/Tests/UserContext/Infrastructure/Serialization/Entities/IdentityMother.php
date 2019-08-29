<?php


namespace App\Tests\UserContext\Infrastructure\Serialization\Entities;

use App\UserContext\Infrastructure\Serialization\Entities\Identity;
use Faker\Factory;

class IdentityMother
{
    /**
     * @return Identity
     */
    public static function create() :Identity
    {
        $faker = Factory::create();
        $identity = new Identity();
        $identity->setId($faker->randomDigit());
        $identity->setIdentity(IdentityDetailMother::random());

        return $identity;
    }


    /**
     * @return Identity
     */
    public static function random() :Identity
    {
        return self::create();
    }
}