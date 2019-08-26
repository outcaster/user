<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Services;

use App\Tests\UserContext\Domain\Entities\PersonMother;
use App\UserContext\Domain\Entities\PersonCollection;
use App\UserContext\Domain\Entities\PhonesCollection;
use App\UserContext\Domain\Entities\PersonPhone;
use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Entities\Phone;
use App\UserContext\Domain\Entities\PhoneNumber;
use App\UserContext\Domain\Entities\PhoneType;
use App\UserContext\Domain\Services\GetPhoneNumberByNameFinder;
use App\UserContext\Domain\Services\PersonByNameFinder;
use App\UserContext\Domain\Services\UserPhonesByPersonFinder;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class GetPhoneNumberByNameFinderTest extends TestCase
{
    /** @test */
    public function itShouldFindAUserPhone(): void
    {
        // ---------------- Given ----------------

        // mock the entities
        $identity = PersonMother::createRandomPerson();

        $phoneOne = \Mockery::mock(Phone::class);
        $phoneOne->shouldReceive('getType')
            ->andReturn(new PhoneType(PhoneType::PERSONAL_NUMBER));
        $phoneOne->shouldReceive('getPhoneNumber')
            ->andReturn(new PhoneNumber('55555555'));

        $phoneTwo = \Mockery::mock(Phone::class);
        $phoneTwo->shouldReceive('getType')
            ->andReturn(new PhoneType(PhoneType::WORK_NUMBER));
        $phoneTwo->shouldReceive('getPhoneNumber')
            ->andReturn(new PhoneNumber('66666666'));

        $phoneThree = \Mockery::mock(Phone::class);
        $phoneThree->shouldReceive('getType')
            ->andReturn(new PhoneType(PhoneType::MOBILE_NUMBER));
        $phoneThree->shouldReceive('getPhoneNumber')
            ->andReturn(new PhoneNumber('77777777'));

        // service mocking (used through query bus)
        $personFinder = \Mockery::mock(PersonByNameFinder::class);
        $personFinder->shouldReceive('find')
            ->andReturn(new PersonCollection([$identity]));

        $userPhonesFinder = \Mockery::mock(UserPhonesByPersonFinder::class);
        $userPhonesFinder->shouldReceive('find')
            ->andReturn(new PhonesCollection([$phoneOne, $phoneTwo, $phoneThree]));

        // initialize the finder
        $getPhoneNumberByNameFinder = new GetPhoneNumberByNameFinder(
            $personFinder,
            $userPhonesFinder
        );

        // ---------------- When ----------------
        $response = $getPhoneNumberByNameFinder->find(new PersonName($identity->getName()->getValue()));

        // ---------------- Then ----------------
        Assert::assertTrue(sizeof($response->items()) > 0);
        Assert::assertSame([
            PersonPhone::PERSON_ID => $identity->getId()->getValue(),
            PersonPhone::PERSON_NAME => $identity->getName()->getValue(),
        ], $response->items()[0]->personInfo);
        Assert::assertEquals($identity->getId()->getValue(), $response->items()[0]->personInfo[PersonPhone::PERSON_ID]);
        Assert::assertSame([
            PhoneType::PERSONAL_NUMBER_TEXT => $phoneOne->getPhoneNumber()->getValue(),
            PhoneType::WORK_NUMBER_TEXT => $phoneTwo->getPhoneNumber()->getValue(),
            PhoneType::MOBILE_NUMBER_TEXT => $phoneThree->getPhoneNumber()->getValue(),
        ], $response->items()[0]->phoneNumbers);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}