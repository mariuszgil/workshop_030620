<?php

namespace Tests\DocFlow\Unit\Domain;

use DocFlow\Domain\Document;
use DocFlow\Domain\DocumentSigner;
use DocFlow\Domain\DocumentStatus;
use DocFlow\Domain\Event;
use DocFlow\Domain\EventPublisher;
use DocFlow\Domain\User;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class DocumentPublicationTest extends TestCase
{
    public function testMustBeSignedDuringPublication()
    {
        $document = (new DocumentFactory())->createVerified();
        $publisher = $this->prophesize(EventPublisher::class)->reveal();
        $signer = $this->prophesize(DocumentSigner::class);

        $signer->sign(
            $document->getAuthor(),
            $document->getNumber()
        )->shouldBeCalledOnce();

        $document->publish($signer->reveal(), $publisher);
    }

    public function testCanBePublishedAfterSuccessfulVerification()
    {
        $document = (new DocumentFactory())->createVerified();
        $signer = $this->prophesize(DocumentSigner::class);
        $publisher = $this->prophesize(EventPublisher::class);
        $publisher->publish(Argument::type(Event::class))->shouldBeCalled();

        $document->publish($signer->reveal(), $publisher->reveal());

        $this->assertEquals(DocumentStatus::PUBLISHED(), $document->getStatus());
    }

    /**
     * @dataProvider getDocumentsToFail
     * @param Document $document
     */
    public function testCantBePublishedWithoutVerification(Document $document)
    {
        $this->expectException(\LogicException::class);
        $signer = $this->prophesize(DocumentSigner::class);
        $publisher = $this->prophesize(EventPublisher::class);
        $publisher->publish(Argument::type(Event::class))->shouldNotBeCalled();

        $document->publish($signer->reveal(), $publisher->reveal());
    }

    public function getDocumentsToFail()
    {
        return [
            [(new DocumentFactory())->createDraft()],
            [(new DocumentFactory())->createArchived()],
        ];
    }
}