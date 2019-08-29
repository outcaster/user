<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\UserContext\Domain\Entities\PersonName;
use App\UserContext\Domain\Services\GetPhoneNumberByNameFinder;

class GetPhoneNumberQueryHandler
{
    /** @var GetPhoneNumberByNameFinder */
    private $getPhoneNumberByNameManager;

    /**
     * GetPhoneNumberQueryHandler constructor.
     * @param GetPhoneNumberByNameFinder $getPhoneNumberByNameManager
     */
    public function __construct(GetPhoneNumberByNameFinder $getPhoneNumberByNameManager)
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
