<?php

namespace App\Domain\User\Exception;

use App\Domain\Common\Exception\NotFoundException;

/**
 * Class UserNotFoundException
 *
 * @package App\Domain\User\Exception
 */
class UserNotFoundException extends NotFoundException
{
    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct("user.exception.not_found", 2004);
    }
}
