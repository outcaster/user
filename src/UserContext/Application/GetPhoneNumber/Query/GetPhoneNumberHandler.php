<?php
declare(strict_types = 1);

namespace App\UserContext\Application\GetPhoneNumber\Query;

use App\UserContext\Domain\Services\GetPhoneNumberByNameManager;

class GetPhoneNumberHandler
{
    private $getPhoneNumberByNameManager;

    public function __construct(GetPhoneNumberByNameManager $getPhoneNumberByNameManager)
    {
        $this->getPhoneNumberByNameManager = $getPhoneNumberByNameManager;
    }

    public function process(GetPhoneQuery $query) :array
    {
        return $this->getPhoneNumberByNameManager->find($query);
    }
}
