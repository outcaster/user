<?php
declare(strict_types = 1);

namespace App\UserContext\Domain\Entities;

use phpDocumentor\Reflection\Types\Integer;

class Identity
{
    /**
     * @Type("integer")
     */
    private $id;

    /**
     * @return integer
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @param integer id
     * @return void
     */
    public function setId($id) :void
    {
        $this->id = $id;
    }
}
