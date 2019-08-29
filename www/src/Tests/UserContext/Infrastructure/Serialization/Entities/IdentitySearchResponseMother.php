<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Infrastructure\Serialization\Entities;


use App\UserContext\Infrastructure\Serialization\Entities\IdentitySearchResponseWrapper;
use Faker\Factory;

class IdentitySearchResponseMother
{
    /**
     * @return IdentitySearchResponseWrapper
     */
    public static function create() :IdentitySearchResponseWrapper
    {
        $faker = Factory::create();
        $amount = $faker->numberBetween(1,5);
        $wrapper = new IdentitySearchResponseWrapper();
        $results = [];

        for($index = 0; $index < $amount; $index++) {
            $results[] = IdentityMother::random();
        }

        $wrapper->setResults($results);

        return $wrapper;
    }


    /**
     * @return IdentitySearchResponseWrapper
     */
    public static function random() :IdentitySearchResponseWrapper
    {
        return self::create();
    }
}