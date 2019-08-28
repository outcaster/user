<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Domain\Entities;

use App\UserContext\Domain\Entities\PhoneType;
use App\UserContext\Domain\Exception\UnknownUserPhoneException;
use PHPUnit\Framework\TestCase;

final class PhoneTypeTest extends TestCase
{
    /** @test */
    public function itShouldGetAKnownType(): void
    {
        // ---------------- Given ----------------
        $person = PhoneMother::createRandomNumber();

        // ---------------- When ----------------
        $type = $person->getType();

        // ---------------- Then ----------------
        self::assertEquals($type->__toString(), $type->getContactName());
        self::assertContains($type->__toString(), PhoneType::KNOWN_PHONE_TYPES);
    }

    /** @test */
    public function itShouldBeAValidType(): void
    {
        // ---------------- Given ----------------
        $this->expectException(UnknownUserPhoneException::class);

        // ---------------- When ----------------
        $phoneType = new PhoneType(random_int(PhoneType::WORK_NUMBER + 1, PHP_INT_MAX));

        // ---------------- Then ----------------
        self::fail('This line shouldn\'t be executed ever. Incorrect phone type: ' . $phoneType);
    }
}
