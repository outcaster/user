<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Services\PhoneNumbersByNameFinder;

class GetPhoneNumberQueryHandler
{
    /** @var PhoneNumbersByNameFinder */
    private $getPhoneNumberByNameManager;

    /**
     * GetPhoneNumberQueryHandler constructor.
     * @param PhoneNumbersByNameFinder $getPhoneNumberByNameManager
     */
    public function __construct(PhoneNumbersByNameFinder $getPhoneNumberByNameManager)
    {
        $this->getPhoneNumberByNameManager = $getPhoneNumberByNameManager;
    }

    /**
     * @param GetPhoneQuery $query
     * @return PhoneQueryResponse|null
     */
    public function __invoke(GetPhoneQuery $query) :?PhoneQueryResponse
    {
        return $this->getPhoneNumberByNameManager->find(new PersonName($query->getName()));
    }
}
