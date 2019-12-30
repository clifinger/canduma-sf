<?php

namespace App\Domain\User\ValueObject;

use App\Domain\Common\ValueObject\AggregateRootId;

/**
 * Class UserId
 *
 * @package App\Domain\User\ValueObject
 */
class UserId extends AggregateRootId
{
    /** @var  string */
    protected $uuid;
}
