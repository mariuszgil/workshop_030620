<?php


namespace DocFlow\Domain;


interface EventPublisher
{
    public function publish(Event $eventToPublish): void;
}