<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Services;

use App\Tests\UserContext\Domain\Entities\PersonMother;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Repository\FindPersonByNameInterface;
use App\UserContext\Domain\Services\PersonByNameFinder;
use PHPUnit\Framework\TestCase;

class PersonByNameFinderTest extends TestCase
{
    /** @test */
    public function itShouldFindAPerson(): void
    {
        // ---------------- Given ----------------
        // mock the entities
        $person = PersonMother::createRandomPerson();

        // repository mocking
        $repository = $this->repository($person->getName()->getValue(), $person);

        // initialize the finder
        $finder = new PersonByNameFinder($repository);

        // ---------------- When ----------------
        $response = $finder->find(new PersonName($person->getName()->getValue()));

        // ---------------- Then ----------------
        self::assertTrue(sizeof($response->items()) > 0);
        self::assertSame($person, $response->items()[0]);
        self::assertEquals($person->id, $response->items()[0]->id);
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }

    /**
     * Generate a mocked repository with one person identified by the given name
     * @param string $name
     * @param Person $person
     * @return FindPersonByNameInterface
     */
    protected function repository(string $name, Person $person): FindPersonByNameInterface
    {
        $identityRepository = \Mockery::mock(FindPersonByNameInterface::class);
        $identityRepository->shouldReceive('search')
            ->with($name)
            ->andReturn([$person]);

        return $identityRepository;
    }
}
