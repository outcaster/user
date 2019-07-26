<?php


namespace App\Tests\UserContext\Domain\Services;


use App\UserContext\Application\GetPhoneNumber\Query\GetPhoneQuery;
use App\UserContext\Domain\Entities\ContactInformation;
use App\UserContext\Domain\Entities\Identity;
use App\UserContext\Domain\Entities\IdentitySearchResponseWrapper;
use App\UserContext\Domain\Repository\ContactInformationRepository;
use App\UserContext\Domain\Repository\IdentityRepository;
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
        $identity = \Mockery::mock(Identity::class);
        $identity->shouldReceive('getId')
                ->andReturn(1);
        $phoneOne = \Mockery::mock(ContactInformation::class);
        $phoneTwo = \Mockery::mock(ContactInformation::class);
        $responseWrapper = \Mockery::mock(IdentitySearchResponseWrapper::class);
        $responseWrapper->shouldReceive('getResults')
            ->andReturn([$identity]);
        // repository mocking
        $identityRepository = \Mockery::mock(IdentityRepository::class);
        $identityRepository->shouldReceive('search')
            ->with('Connor')
            ->andReturn($responseWrapper);
        $contactInformationRepository = \Mockery::mock(ContactInformationRepository::class);
        $contactInformationRepository->shouldReceive('search')
            ->with(1)
            ->andReturn([$phoneOne, $phoneTwo]);
        // initialize the finder
        $getPhoneNumberByNameFinder = new GetPhoneNumberByNameFinder(
            $identityRepository,
            $contactInformationRepository
        );

        // When
        $response = $getPhoneNumberByNameFinder->find(new GetPhoneQuery('Connor'));

        // Then
        Assert::assertTrue(sizeof($response) > 0);
        Assert::assertSame($identity, $response[0]->identity);
        Assert::assertSame([$phoneOne, $phoneTwo], $response[0]->phoneNumbers);
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}