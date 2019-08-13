<?php


namespace App\Tests\UserContext\Domain\Services;


use App\Shared\Infrastructure\CQRS\Query\InMemoryQueryBus;
use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQuery;
use App\UserContext\Application\FindPersonByName\Query\FindPersonByNameQueryHandler;
use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQuery;
use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQueryHandler;
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
    public function itShouldFindAUserPhone()
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

        // queries
        $personQuery = new FindPersonByNameQuery('Connor');
        $userPhonesQuery = new FindUserPhonesByPersonQuery($identity);

        // service mocking (used through query bus)
        $personFinder = \Mockery::mock(PersonByNameFinder::class);
        $personFinder->shouldReceive('find')
            //->with($personQuery)
            ->andReturn([$identity]);

        $userPhonesFinder = \Mockery::mock(UserPhonesByPersonFinder::class);
        $userPhonesFinder->shouldReceive('find')
            //->with($userPhonesQuery)
            ->andReturn([$phoneOne, $phoneTwo, $phoneThree]);

        // handlers
        $findPeopleHandler = new FindPersonByNameQueryHandler($personFinder);
        $findPhoneHandler = new FindUserPhonesByPersonQueryHandler($userPhonesFinder);

        // initialize the finder
        $getPhoneNumberByNameFinder = new GetPhoneNumberByNameFinder(
            new InMemoryQueryBus([$findPeopleHandler, $findPhoneHandler])
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