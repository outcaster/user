<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

class ContactInformation
{
    /**
     * @var ContactInformationType
     */
    public $type;
    public $phoneNumber;
}
