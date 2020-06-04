<?php

namespace Tests\DocFlow\Unit\Domain;

use DocFlow\Domain\Document;
use DocFlow\Domain\DocumentStatus;
use DocFlow\Domain\Event;
use DocFlow\Domain\EventPublisher;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class DocumentPublicationTest extends TestCase
{
    public function testCanBePublishedAfterSuccessfulVerification()
    {
        $document = (new DocumentFactory())->createVerified();
        $publisher = $this->prophesize(EventPublisher::class);
        $publisher->publish(Argument::type(Event::class))->shouldBeCalled();

        $document->publish($publisher->reveal());

        $this->assertEquals(DocumentStatus::PUBLISHED(), $document->getStatus());
    }

    /**
     * @dataProvider getDocumentsToFail
     * @param Document $document
     */
    public function testCantBePublishedWithoutVerification(Document $document)
    {
        $this->expectException(\LogicException::class);
        $publisher = $this->prophesize(EventPublisher::class);
        $publisher->publish(Argument::type(Event::class))->shouldNotBeCalled();

        $document->publish($publisher->reveal());
    }

    public function getDocumentsToFail()
    {
        return [
            [(new DocumentFactory())->createDraft()],
            [(new DocumentFactory())->createArchived()],
        ];
    }
}