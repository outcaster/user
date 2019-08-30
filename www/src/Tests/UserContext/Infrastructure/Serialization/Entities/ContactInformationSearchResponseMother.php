<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Infrastructure\Serialization\Entities;


use App\UserContext\Infrastructure\Serialization\Entities\ContactInformationSearchResponseWrapper;
use Faker\Factory;

class ContactInformationSearchResponseMother
{
    /**
     * @return ContactInformationSearchResponseWrapper
     */
    public static function create() :ContactInformationSearchResponseWrapper
    {
        $faker = Factory::create();
        $amount = $faker->numberBetween(1,3);
        $wrapper = new ContactInformationSearchResponseWrapper();
        $results = [];

        for($index = 0; $index < $amount; $index++) {
            $results[] = ContactInformationMother::random();
        }

        $wrapper->setResults($results);

        return $wrapper;
    }

    /**
     * @return ContactInformationSearchResponseWrapper
     */
    public static function createMixed() :ContactInformationSearchResponseWrapper
    {
        $faker = Factory::create();
        $amountValid = $faker->numberBetween(1,3);
        $amountInvalid = $faker->numberBetween(1,3);
        $wrapper = new ContactInformationSearchResponseWrapper();
        $results = [];

        for($index = 0; $index < $amountValid; $index++) {
            $results[] = ContactInformationMother::random();
        }

        for($index = 0; $index < $amountInvalid; $index++) {
            $results[] = ContactInformationMother::randomInvalid();
        }

        $wrapper->setResults($results);

        return $wrapper;
    }

    /**
     * @return ContactInformationSearchResponseWrapper
     */
    public static function random() :ContactInformationSearchResponseWrapper
    {
        return self::create();
    }

    /**
     * @return ContactInformationSearchResponseWrapper
     */
    public static function randomMixed() :ContactInformationSearchResponseWrapper
    {
        return self::createMixed();
    }
}