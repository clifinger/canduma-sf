<?php

namespace App\Infra\Common\Event;

use App\Domain\Common\ValueObject\AggregateRootId;

class EventAwareId extends AggregateRootId
{
    /** @var string */
    protected $uuid;
}
