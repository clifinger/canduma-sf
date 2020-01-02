<?php


namespace App\Infra\Common\Bus;


use App\Domain\Common\Message\MessageTransportInterface;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class MessageDispatcher implements MessageBusInterface, MessageTransportInterface
{
    /**
     * @var MessageBusInterface $bus
     */
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->bus = $eventBus;
    }

    /**
     * @inheritDoc
     */
    public function dispatch($message, array $stamps = []): Envelope
    {
        $this->bus->dispatch(
            (new Envelope($message, $stamps))
        );
    }

    public function dispatchRoutedMessageAfterMiddleware($message, array $metadata = [])
    {
        $this->bus->dispatch(
            (new Envelope($message, $metadata))
                ->with(
                    new DispatchAfterCurrentBusStamp()
                )
        );
    }
}