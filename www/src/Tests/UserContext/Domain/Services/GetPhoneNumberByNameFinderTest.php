<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Services;

use App\Tests\UserContext\Domain\Entities\PersonMother;
use App\Tests\UserContext\Domain\Entities\PhoneMother;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\PersonCollection;
use App\UserContext\Domain\Entities\Phone;
use App\UserContext\Domain\Entities\PhonesCollection;
use App\UserContext\Domain\Entities\PersonPhone;
use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Entities\PhoneType;
use App\UserContext\Domain\Services\GetPhoneNumberByNameFinder;
use App\UserContext\Domain\Services\PersonByNameFinder;
use App\UserContext\Domain\Services\UserPhonesByPersonFinder;
use PHPUnit\Framework\TestCase;

class GetPhoneNumberByNameFinderTest extends TestCase
{
    /** @test */
    public function itShouldFindAUserPhone(): void
    {
        // ---------------- Given ----------------

        // mock the entities
        $identity = PersonMother::createRandomPerson();
        $personalNumber = PhoneMother::createRandomPersonalNumber();
        $workNumber = PhoneMother::createRandomWorkNumber();
        $mobileNumber = PhoneMother::createRandomMobileNumber();
        $phones = [$personalNumber, $workNumber, $mobileNumber];
        $this->ensurePhonesToString($phones);

        // initialize the finder
        $getPhoneNumberByNameFinder = $this->finder($identity, $phones);

        // ---------------- When ----------------
        $response = $getPhoneNumberByNameFinder->find(new PersonName($identity->getName()->getValue()));
        $personPhonesArray = $response->getPersonPhones();

        // ---------------- Then ----------------
        self::assertTrue(sizeof($personPhonesArray) > 0);
//        self::assertSame([
//            PersonPhone::PERSON_ID => $identity->getId()->getValue(),
//            PersonPhone::PERSON_NAME => $identity->getName()->getValue(),
//        ], $personPhonesArray[0]->getPerson()->personInfo);
//        self::assertSame([
//            PhoneType::PERSONAL_NUMBER_TEXT => $personalNumber->getPhoneNumber()->getValue(),
//            PhoneType::WORK_NUMBER_TEXT => $workNumber->getPhoneNumber()->getValue(),
//            PhoneType::MOBILE_NUMBER_TEXT => $mobileNumber->getPhoneNumber()->getValue(),
//        ], $personPhonesArray[0]->phoneNumbers);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }

    /**
     * IGet a finder for one person and all the given phones
     *
     * @param Person $person
     * @param Phone[] $phones
     *
     * @return GetPhoneNumberByNameFinder
     */
    protected function finder(Person $person, array $phones): GetPhoneNumberByNameFinder
    {
        // service mocking
        $personFinder = \Mockery::mock(PersonByNameFinder::class);
        $personFinder->shouldReceive('find')
            ->andReturn(new PersonCollection([$person]));
        $userPhonesFinder = \Mockery::mock(UserPhonesByPersonFinder::class);
        $userPhonesFinder->shouldReceive('find')
            ->andReturn(new PhonesCollection($phones));

        return new GetPhoneNumberByNameFinder(
            $personFinder,
            $userPhonesFinder
        );
    }

    /**
     * @param Phone[] $phones
     */
    protected function ensurePhonesToString(array $phones): void
    {
        foreach ($phones as $phoneNumber) {
            self::assertEquals($phoneNumber->getType() . ':' . $phoneNumber->getPhoneNumber()->getValue(), $phoneNumber->__toString());
        }
    }
}
