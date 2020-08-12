<?php

namespace packages\Domain\Domain\Account;

class AccountId
{
    private $value;

    /**
     * AccountId constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
