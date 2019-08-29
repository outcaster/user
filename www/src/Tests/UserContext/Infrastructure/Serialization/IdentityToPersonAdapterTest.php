<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Infrastructure;


use App\Tests\UserContext\Infrastructure\Serialization\Entities\IdentitySearchResponseMother;
use App\UserContext\Domain\Entities\Person;
use App\UserContext\Infrastructure\Serialization\Adapter\IdentityToPersonAdapter;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

class IdentityToPersonAdapterTest extends TestCase
{
    const IDENTITY_ID = 'IDENTITY_ID';
    const NAME = 'NAME';

    /** @test */
    public function itShouldConvert(): void
    {
        $converter = new IdentityToPersonAdapter();
        $wrapper = IdentitySearchResponseMother::random();

        $expected = [];
        foreach ($wrapper->getResults() as $identity) {

            $fullName = $identity->getIdentity()->getFirstName() !== null ?
                $identity->getIdentity()->getFirstName() : '';
            if ($identity->getIdentity()->getName() !== null) {
                $fullName .= $fullName !== null ? ' ' . $identity->getIdentity()->getName() :
                    $identity->getIdentity()->getName();
            }

            $expected[] = [
                self::IDENTITY_ID => $identity->getId(),
                self::NAME => $fullName,
            ];
        }

        $people = $converter->parse($wrapper);
        foreach($people as $index => $person) {
            Assert::assertInstanceOf(Person::class, $person);
            Assert::assertEquals($expected[$index][self::IDENTITY_ID], $person->getId()->getValue());
            Assert::assertEquals($expected[$index][self::NAME], $person->getName()->getValue());
        }
    }
}