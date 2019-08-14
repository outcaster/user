<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Services;

use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQueryResponse;
use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQueryResponse;
use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\UserPhone;
use App\UserContext\Domain\Entities\UserPhoneType;
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
        $identity = \Mockery::mock(Person::class);
        $identity->shouldReceive('getId')
                ->andReturn(1);

        $phoneOne = \Mockery::mock(UserPhone::class);
        $phoneOne->shouldReceive('getType')
            ->andReturn(new UserPhoneType(UserPhoneType::PERSONAL_NUMBER));
        $phoneOne->shouldReceive('getPhoneNumber')
            ->andReturn('55555555');

        $phoneTwo = \Mockery::mock(UserPhone::class);
        $phoneTwo->shouldReceive('getType')
            ->andReturn(new UserPhoneType(UserPhoneType::WORK_NUMBER));
        $phoneTwo->shouldReceive('getPhoneNumber')
            ->andReturn('66666666');

        $phoneThree = \Mockery::mock(UserPhone::class);
        $phoneThree->shouldReceive('getType')
            ->andReturn(new UserPhoneType(UserPhoneType::MOBILE_NUMBER));
        $phoneThree->shouldReceive('getPhoneNumber')
            ->andReturn('77777777');

        // service mocking (used through query bus)
        $personFinder = \Mockery::mock(PersonByNameFinder::class);
        $personFinder->shouldReceive('find')
            ->andReturn(new FindPersonByNameQueryResponse([$identity]));

        $userPhonesFinder = \Mockery::mock(UserPhonesByPersonFinder::class);
        $userPhonesFinder->shouldReceive('find')
            ->andReturn(new FindUserPhonesByPersonQueryResponse([$phoneOne, $phoneTwo, $phoneThree]));

        // initialize the finder
        $getPhoneNumberByNameFinder = new GetPhoneNumberByNameFinder(
            $personFinder,
            $userPhonesFinder
        );

        // ---------------- When ----------------
        $response = $getPhoneNumberByNameFinder->find(new GetPhoneQuery('Connor'));

        // ---------------- Then ----------------
        Assert::assertTrue(sizeof($response->items()) > 0);
        Assert::assertSame($identity, $response->items()[0]->person);
        Assert::assertEquals($identity->id, $response->items()[0]->person->id);
        Assert::assertSame([
            UserPhoneType::PERSONAL_NUMBER_TEXT => $phoneOne->getPhoneNumber(),
            UserPhoneType::WORK_NUMBER_TEXT => $phoneTwo->getPhoneNumber(),
            UserPhoneType::MOBILE_NUMBER_TEXT => $phoneThree->getPhoneNumber(),
        ], $response->items()[0]->phoneNumbers);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}