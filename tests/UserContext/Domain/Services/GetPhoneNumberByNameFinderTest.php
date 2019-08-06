<?php


namespace App\Tests\UserContext\Domain\Services;


use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\UserPhone;
use App\UserContext\Domain\Entities\UserPhoneType;
use App\UserContext\Domain\Repository\SearchUserPhoneNumbersRepository;
use App\UserContext\Domain\Repository\SearchPersonRepository;
use App\UserContext\Domain\Services\GetPhoneNumberByNameFinder;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class GetPhoneNumberByNameFinderTest extends TestCase
{
    /** @test */
    public function itShouldFindAUserPhone()
    {
        // Given
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
        // repository mocking
        $identityRepository = \Mockery::mock(SearchPersonRepository::class);
        $identityRepository->shouldReceive('search')
            ->with('Connor')
            ->andReturn([$identity]);
        $contactInformationRepository = \Mockery::mock(SearchUserPhoneNumbersRepository::class);
        $contactInformationRepository->shouldReceive('search')
            ->with(1)
            ->andReturn([$phoneOne, $phoneTwo, $phoneThree]);
        // initialize the finder
        $getPhoneNumberByNameFinder = new GetPhoneNumberByNameFinder(
            $identityRepository,
            $contactInformationRepository
        );

        // When
        $response = $getPhoneNumberByNameFinder->find(new GetPhoneQuery('Connor'));

        // Then
        Assert::assertTrue(sizeof($response) > 0);
        Assert::assertSame($identity, $response[0]->person);
        Assert::assertEquals($identity->id, $response[0]->person->id);
        Assert::assertSame([
            UserPhoneType::PERSONAL_NUMBER_TEXT => $phoneOne->getPhoneNumber(),
            UserPhoneType::WORK_NUMBER_TEXT => $phoneTwo->getPhoneNumber(),
            UserPhoneType::MOBILE_NUMBER_TEXT => $phoneThree->getPhoneNumber(),
        ], $response[0]->phoneNumbers);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}