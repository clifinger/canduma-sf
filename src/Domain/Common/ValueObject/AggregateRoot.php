<?php

namespace App\Domain\Common\ValueObject;

use App\Domain\Common\Event\EventInterface;
use App\Domain\Common\Event\EventPublisher;

abstract class AggregateRoot
{
    /**
     * @var AggregateRootId
     */
    protected $uuid;

    protected function __construct(AggregateRootId $aggregateRootId)
    {
        $this->uuid = $aggregateRootId;
    }

    public function uuid(): AggregateRootId
    {
        return $this->uuid;
    }

    final public function equals(AggregateRootId $aggregateRootId)
    {
        return $this->uuid->equals($aggregateRootId);
    }

    final protected function raise(EventInterface $event): void
    {
        EventPublisher::raise($event);
    }

    public function __toString(): string
    {
        return (string) $this->uuid;
    }
}
