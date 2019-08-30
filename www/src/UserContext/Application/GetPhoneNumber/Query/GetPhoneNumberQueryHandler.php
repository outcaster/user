<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\UserContext\Domain\Entities\PersonPhonesCollection;
use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Services\PhoneNumbersByNameFinder;

class GetPhoneNumberQueryHandler
{
    /** @var PhoneNumbersByNameFinder */
    private $getPhoneNumberByNameManager;

    public function __construct(PhoneNumbersByNameFinder $getPhoneNumberByNameManager)
    {
        $this->getPhoneNumberByNameManager = $getPhoneNumberByNameManager;
    }

    public function __invoke(GetPhoneQuery $query) :?PersonPhonesCollection
    {
        return $this->getPhoneNumberByNameManager->find(new PersonName($query->getName()));
    }
}
