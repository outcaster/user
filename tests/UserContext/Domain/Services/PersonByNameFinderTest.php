<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Services;

use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Repository\SearchPersonRepository;
use App\UserContext\Domain\Services\PersonByNameFinder;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class PersonByNameFinderTest extends TestCase
{
    /** @test */
    public function itShouldFindAPerson(): void
    {
        // ---------------- Given ----------------
        // mock the entities
        $person = \Mockery::mock(Person::class);
        $person->shouldReceive('getId')
                ->andReturn(1);

        // repository mocking
        $identityRepository = \Mockery::mock(SearchPersonRepository::class);
        $identityRepository->shouldReceive('search')
            ->with('Connor')
            ->andReturn([$person]);

        // initialize the finder
        $finder = new PersonByNameFinder($identityRepository);

        // ---------------- When ----------------
        $response = $finder->find(new PersonName('Connor'));

        // ---------------- Then ----------------
        Assert::assertTrue(sizeof($response->items()) > 0);
        Assert::assertSame($person, $response->items()[0]);
        Assert::assertEquals($person->id, $response->items()[0]->id);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}