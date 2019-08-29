<?php
declare(strict_types = 1);

namespace App\UserContext\Infrastructure\Serialization\Entities;

use phpDocumentor\Reflection\Types\Integer;

class Identity
{
    /**
     * @Type("integer")
     * @var int
     */
    private $id;

    /**
     * @Type("App\UserContext\Infrastructure\Serialization\Entities\IdentityDetail")
     * @var IdentityDetail
     */
    private $identity;

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return void
     */
    public function setId(int $id) :void
    {
        $this->id = $id;
    }

    /**
     * @return IdentityDetail
     */
    public function getIdentity(): IdentityDetail
    {
        return $this->identity;
    }

    /**
     * @param IdentityDetail $identity
     */
    public function setIdentity(IdentityDetail $identity): void
    {
        $this->identity = $identity;
    }
}
