<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Infrastructure\Serialization\Entities;


use App\UserContext\Infrastructure\Serialization\Entities\ContactInformation;
use Faker\Factory;

class ContactInformationMother
{
    /**
     * @return ContactInformation
     */
    public static function create() :ContactInformation
    {
        $faker = Factory::create();

        $contact = new ContactInformation();
        $contact->setContactInformationId($faker->numberBetween(1,3));
        $contact->setContactInformationIdentity(ContactInformationIdentityMother::random());

        return $contact;
    }

    /**
     * @return ContactInformation
     */
    public static function createInvalid() :ContactInformation
    {
        $faker = Factory::create();

        $contact = new ContactInformation();
        $contact->setContactInformationId($faker->numberBetween(10,15));
        $contact->setContactInformationIdentity(ContactInformationIdentityMother::random());

        return $contact;
    }

    /**
     * @return ContactInformation
     */
    public static function random() :ContactInformation
    {
        return self::create();
    }

    /**
     * @return ContactInformation
     */
    public static function randomInvalid() :ContactInformation
    {
        return self::createInvalid();
    }
}
