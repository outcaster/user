<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Services;

use App\Tests\UserContext\Domain\Entities\PhoneMother;
use App\UserContext\Domain\Entities\PersonId;
use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;
use App\UserContext\Domain\Services\PhonesByPersonFinder;
use PHPUnit\Framework\TestCase;

class UserPhonesByPersonFinderTest extends TestCase
{
    /** @test */
    public function itShouldFindUserPhones(): void
    {
        //----------------  Given ----------------
        $phoneOne = PhoneMother::createRandomNumber();
        $phoneTwo = PhoneMother::createRandomNumber();
        $phoneThree = PhoneMother::createRandomNumber();

        // repository mocking
        $contactInformationRepository = \Mockery::mock(SearchUserPhoneNumbersRepository::class);
        $contactInformationRepository->shouldReceive('search')
            ->with(1)
            ->andReturn([$phoneOne, $phoneTwo, $phoneThree]);

        // initialize the finder
        $finder = new PhonesByPersonFinder($contactInformationRepository);

        // ---------------- When ----------------
        $response = $finder->find(new PersonId(1));

        // ---------------- Then ----------------
        self::assertTrue(sizeof($response->items()) === 3);
        self::assertSame($phoneOne, $response->items()[0]);
        self::assertSame($phoneTwo, $response->items()[1]);
        self::assertSame($phoneThree, $response->items()[2]);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}
