<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Infrastructure\Serialization;

use App\Tests\UserContext\Infrastructure\Serialization\Entities\IdentityResponseMother;
use App\UserContext\Infrastructure\Serialization\Entities\Identity;
use App\UserContext\Infrastructure\Serialization\Entities\IdentitySearchResponseWrapper;
use App\UserContext\Infrastructure\Serialization\SymfonyDeserializer;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class SymfonySerializerTest extends TestCase
{
    /** @test */
    public function itShouldDeserialize(): void
    {
        $serializer = new SymfonyDeserializer();
        $data = IdentityResponseMother::random();
        $object = json_encode($data[IdentityResponseMother::OBJECT]);
        $expected = $data[IdentityResponseMother::EXPECTED];
        $result = $serializer->deserialize(
            $object, IdentitySearchResponseWrapper::class, 'json'
        );

        Assert::assertInstanceOf(IdentitySearchResponseWrapper::class, $result);
        Assert::assertTrue(sizeof($result->getResults()) === count($expected));

        foreach($result->getResults() as $index => $identity) {
            Assert::assertInstanceOf(Identity::class, $identity);
            Assert::assertEquals(
                $expected[$index][IdentityResponseMother::IDENTITY_ID],
                $identity->getId()
            );
            Assert::assertEquals(
                $expected[$index][IdentityResponseMother::NAME],
                $identity->getIdentity()->getName()
            );
            Assert::assertEquals(
                $expected[$index][IdentityResponseMother::FIRST_NAME],
                $identity->getIdentity()->getFirstName()
            );
        }
    }
}