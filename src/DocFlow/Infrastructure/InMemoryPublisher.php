<?php


namespace DocFlow\Infrastructure;


use DocFlow\Domain\Event;
use DocFlow\Domain\EventPublisher;

class InMemoryPublisher implements EventPublisher
{

    public function publish(Event $eventToPublish): void
    {
        // TODO: Implement publish() method.
    }
}