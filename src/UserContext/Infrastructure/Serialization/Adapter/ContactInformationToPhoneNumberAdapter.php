<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Adapter;

use App\UserContext\Domain\Entities\Phone;
use App\UserContext\Domain\Entities\PhoneNumber;
use App\UserContext\Domain\Entities\PhoneType;
use App\UserContext\Domain\Exception\UnknownUserPhoneException;
use App\UserContext\Infrastructure\Serialization\Entities\ContactInformation;
use App\UserContext\Infrastructure\Serialization\Entities\ContactInformationSearchResponseWrapper;

class ContactInformationToPhoneNumberAdapter
{
    /**
     * @param ContactInformationSearchResponseWrapper $searchResponseWrapper
     * @return Phone[]
     */
    public function parse(ContactInformationSearchResponseWrapper $searchResponseWrapper) : array
    {
        $result = [];
        /** @var ContactInformation[] $contacts */
        foreach ($searchResponseWrapper->getResults() as $contact) {
            $phoneNumber = (!empty($contact->getContactInformationIdentity())
                && !empty($contact->getContactInformationIdentity()->getData())) ?
                $contact->getContactInformationIdentity()->getData() : '';
            try {
                $userPhone = new Phone(
                    new PhoneType($contact->getContactInformationId()),
                    new PhoneNumber($phoneNumber)
                );
                $result[] = $userPhone;
            } catch (UnknownUserPhoneException $e) {
               // this user phone is ignored
                continue;
            }
        }

        return $result;
    }
}
