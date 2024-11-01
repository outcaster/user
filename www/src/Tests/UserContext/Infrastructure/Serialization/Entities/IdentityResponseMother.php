<?php


namespace App\Tests\UserContext\Infrastructure\Serialization\Entities;

use Faker\Factory;

class IdentityResponseMother
{
    const OBJECT = 'OBJECT';
    const EXPECTED = 'EXPECTED';
    const IDENTITY_ID = 'IDENTITY_ID';
    const NAME = 'NAME';
    const FIRST_NAME = 'FIRST_NAME';

    /**
     * @return array
     */
    public static function create() :array
    {
        $faker = Factory::create();
        $identities = [];
        $amount = $faker->numberBetween(1,5);
        $values = [];

        for ($index = 0; $index < $amount; $index++) {
            $identityId = $faker->unique()->randomDigitNotNull();
            $firstName = $faker->firstName();
            $name = $faker->lastName();
            $values[$index] = [
                self::IDENTITY_ID => $identityId,
                self::FIRST_NAME => $firstName,
                self::NAME => $name,
            ];

            $identities[] = [
                "gender_id" => null,
                "title_id" => 7,
                "matrimony_id" => null,
                "nationality_id" => null,
                "user_id" => null,
                "id" => $identityId,
                "identity" => [
                    "name" => $name,
                    "maiden_name" => null,
                    "middle_name" => null,
                    "first_name" => $firstName,
                    "birth_date" => null,
                    "birth_place" => null,
                    "import_id" => 0,
                    "address" => 4226,
                    "reference" => "8001501|0|8243",
                    "show_avatar" => true,
                    "accept_receipt_text_message" => true,
                    "accept_receipt_email" => true,
                    "type" => null,
                    "guid" => "48N021E3",
                    "status" => null,
                    "market_number" => null,
                    "market_city" => null,
                    "vat_number" => null,
                    "national_number" => null,
                    "initials" => null,
                    "digital_docs" => false,
                    "gdpr_delete" => false,
                ]
            ];
        }

        return [
            self::OBJECT => [
                "status"     => "success",
                "code"       => 200,
                "total_rows" => $amount,
                "start"      => 0,
                "count"      => $amount,
                "results"    => $identities,
            ],
            self::EXPECTED => $values,
        ];
    }

    /**
     * @return array
     */
    public static function random() :array
    {
        return self::create();
    }
}