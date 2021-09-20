<?php

namespace Pagaleve\PHP\Checkout;

class Shopper
{
    private $first_name = "";
    private $last_name = "";

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }
}
