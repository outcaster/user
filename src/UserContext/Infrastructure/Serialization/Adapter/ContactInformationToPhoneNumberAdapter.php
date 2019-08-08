<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Adapter;

use App\UserContext\Domain\Entities\UserPhone;
use App\UserContext\Domain\Entities\UserPhoneType;
use App\UserContext\Domain\Exception\UnknownUserPhoneException;
use App\UserContext\Infrastructure\Serialization\Entities\ContactInformation;
use App\UserContext\Infrastructure\Serialization\Entities\ContactInformationSearchResponseWrapper;

class ContactInformationToPhoneNumberAdapter
{
    /**
     * @param ContactInformationSearchResponseWrapper $searchResponseWrapper
     * @return UserPhone[]
     */
    public function parse(ContactInformationSearchResponseWrapper $searchResponseWrapper) : array
    {
        $result = [];
        /** @var ContactInformation[] $contacts */
        foreach ($searchResponseWrapper->getResults() as $contacts) {
            foreach ($contacts as $contact) {
                $phoneNumber = (!empty($contact->getContactInformationIdentity())
                    && !empty($contact->getContactInformationIdentity()->getData())) ?
                    $contact->getContactInformationIdentity()->getData() : '';
                try {
                    $userPhone = new UserPhone(
                        new UserPhoneType($contact->getContactInformationId()),
                        $phoneNumber
                    );
                    $result[] = $userPhone;
                } catch (UnknownUserPhoneException $e) {
                   // this user phone is ignored
                    continue;
                }
            }
        }

        return $result;
    }
}
