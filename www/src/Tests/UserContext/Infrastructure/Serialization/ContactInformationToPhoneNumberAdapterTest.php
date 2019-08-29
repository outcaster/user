<?php
declare(strict_types = 1);

namespace App\Tests\UserContext\Infrastructure;

use App\Tests\UserContext\Infrastructure\Serialization\Entities\ContactInformationSearchResponseMother;
use App\UserContext\Domain\Entities\Phone;
use App\UserContext\Infrastructure\Serialization\Adapter\ContactInformationToPhoneNumberAdapter;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

class ContactInformationToPhoneNumberAdapterTest extends TestCase
{
    /** @test */
    public function itShouldConvertValidElements(): void
    {
        $converter = new ContactInformationToPhoneNumberAdapter();
        $wrapper = ContactInformationSearchResponseMother::random();

        $expected = [];
        foreach ($wrapper->getResults() as $contactInfo) {
            $expected[] = $contactInfo->getContactInformationIdentity()->getData();
        }

        $contactsInfo = $converter->parse($wrapper);
        foreach($contactsInfo as $index => $contact) {
            Assert::assertInstanceOf(Phone::class, $contact);
            Assert::assertEquals($expected[$index], $contact->getPhoneNumber()->getValue());
        }
    }

    /** @test */
    public function itShouldIgnoreInvalidElements(): void
    {
        $converter = new ContactInformationToPhoneNumberAdapter();
        $wrapper = ContactInformationSearchResponseMother::randomMixed();

        $expected = 0;
        foreach($wrapper->getResults() as $contactInfo) {
            if ($contactInfo->getContactInformationId() > 0 && $contactInfo->getContactInformationId() < 4) {
                $expected++;
            }
        }

        $contactsInfo = $converter->parse($wrapper);
        Assert::assertEquals($expected, count($contactsInfo));
    }
}