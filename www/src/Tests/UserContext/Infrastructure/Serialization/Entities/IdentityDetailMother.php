<?php


namespace App\Tests\UserContext\Infrastructure\Serialization\Entities;

use App\UserContext\Infrastructure\Serialization\Entities\IdentityDetail;
use Faker\Factory;

class IdentityDetailMother
{
    /**
     * @return Identity
     */
    public static function create() :IdentityDetail
    {
        $faker = Factory::create();
        $detail = new IdentityDetail();
        $detail->setName($faker->lastName());
        $detail->setFirstName($faker->firstName());

        return $detail;
    }

    /**
     * @return IdentityDetail
     */
    public static function random() :IdentityDetail
    {
        return self::create();
    }
}