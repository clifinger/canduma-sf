<?php

namespace App\Domain\Security\Exception;

/**
 * Class InvalidPasswordException
 *
 * @package App\Domain\Security\Exception
 */
class InvalidPasswordException extends \InvalidArgumentException
{
    /**
     * InvalidPasswordException constructor.
     */
    public function __construct()
    {
        parent::__construct("security.exception.invalid_password", 6005);
    }
}
