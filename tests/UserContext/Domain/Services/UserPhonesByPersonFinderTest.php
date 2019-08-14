<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Services;

use App\UserContext\Application\FindUserPhonesByPerson\Query\FindUserPhonesByPersonQuery;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\UserPhone;
use App\UserContext\Domain\Entities\UserPhoneType;
use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;
use App\UserContext\Domain\Services\UserPhonesByPersonFinder;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UserPhonesByPersonFinderTest extends TestCase
{
    /** @test */
    public function itShouldFindUserPhones(): void
    {
        //----------------  Given ----------------
        // mock the entities
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getId')
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

        // repository mocking
        $contactInformationRepository = \Mockery::mock(SearchUserPhoneNumbersRepository::class);
        $contactInformationRepository->shouldReceive('search')
            ->with(1)
            ->andReturn([$phoneOne, $phoneTwo, $phoneThree]);

        // initialize the finder
        $finder = new UserPhonesByPersonFinder($contactInformationRepository);

        // ---------------- When ----------------
        $response = $finder->find(new FindUserPhonesByPersonQuery($person));

        // ---------------- Then ----------------
        Assert::assertTrue(sizeof($response->items()) === 3);
        Assert::assertSame($phoneOne, $response->items()[0]);
        Assert::assertSame($phoneTwo, $response->items()[1]);
        Assert::assertSame($phoneThree, $response->items()[2]);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}
