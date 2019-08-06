<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Adapter;

use App\UserContext\Domain\Entities\Person;
use App\UserContext\Infrastructure\Serialization\Entities\Identity;
use App\UserContext\Infrastructure\Serialization\Entities\IdentitySearchResponseWrapper;

class IdentityToPersonAdapter
{
    /**
     * @param IdentitySearchResponseWrapper $identitySearchResponseWrapper
     * @return Person[]
     */
    public function parse(IdentitySearchResponseWrapper $identitySearchResponseWrapper) : array
    {
        $result = [];
        /** @var Identity $identity */
        foreach ($identitySearchResponseWrapper->getResults() as $identity) {
            $fullName = !empty($identity->getIdentity()->getFirstName()) ?
                $identity->getIdentity()->getFirstName() : '';
            if (!empty($identity->getIdentity()->getName())) {
                $fullName .= !empty($fullName) ? ' ' . $identity->getIdentity()->getName() :
                    $identity->getIdentity()->getName();
            }

            $person = new Person($identity->getId(), $fullName);
            $result[] = $person;
        }

        return $result;
    }
}
