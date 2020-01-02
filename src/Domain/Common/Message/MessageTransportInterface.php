<?php


namespace App\Domain\Common\Message;


interface MessageTransportInterface
{
    public function dispatchRoutedMessageAfterMiddleware ($message, array $metadata = []) ;
}