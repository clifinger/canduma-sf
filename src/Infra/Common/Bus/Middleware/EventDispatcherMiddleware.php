<?php

namespace App\Infra\Common\Bus\Middleware;

use App\Domain\Common\Event\EventDispatcherInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class EventDispatcherMiddleware implements MiddlewareInterface
{

    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $returnValue = $stack->next()->handle($envelope, $stack);
        $this->eventDispatcher->dispatch();

        return $returnValue;
    }
}