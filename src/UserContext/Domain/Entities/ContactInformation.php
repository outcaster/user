<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

class ContactInformation
{
    /**
     * @var ContactInformationType
     */
    public $type;
    public $phoneNumber;
}
