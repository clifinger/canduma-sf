<?php

namespace App\Domain\Common\Exception;

/**
 * Class InvalidUUIDException
 *
 * @package App\Domain\Common\Exception
 */
class InvalidUUIDException extends \InvalidArgumentException
{
    /**
     * InvalidUUIDException constructor.
     */
    public function __construct()
    {
        parent::__construct("aggregator_root.exception.invalid_uuid", 400);
    }
}
