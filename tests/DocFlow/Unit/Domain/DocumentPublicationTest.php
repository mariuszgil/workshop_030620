<?php

namespace Tests\DocFlow\Unit\Domain;

use DocFlow\Domain\Clock;
use DocFlow\Domain\Clock\Fixed;
use DocFlow\Domain\Document;
use DocFlow\Domain\DocumentStatus;
use DocFlow\Domain\DocumentType;
use DocFlow\Domain\User;
use PHPUnit\Framework\TestCase;

// TEST CASE CLASS PER CLASS
// TEST CASE CLASS PER FEATURE -> 2 podejscie
class DocumentPublicationTest extends DocumentBaseTest
{
    public function testCanBeVerifiedWhenXxx()
    {
        $document = $this->createDocument(DocumentType::INSTRUCTION());
        $document->changeContent('new title', 'new content');

        $document->verify($this->verifier);

        $this->assertEquals(DocumentStatus::VERIFIED(), $document->getStatus());
        $this->assertEquals($this->verifier, $document->getVerifier());
    }

    //public function test_cant_be_self_verified()
    public function testCantBeSelfVerified()
    {
        $this->expectException(\LogicException::class);

        $document = $this->createDocument(DocumentType::INSTRUCTION());
        $document->changeContent('new title', 'new content');

        $document->verify($this->author);
    }

    public function testCantBeVerifiedMultipleTimes()
    {
        $this->expectException(\LogicException::class);

        $document = $this->createDocument(DocumentType::INSTRUCTION());
        $document->changeContent('new title', 'new content');

        $document->verify($this->verifier);
        $document->verify($this->verifier);
    }

    public function testCantBeVerifiedWithoutTitle()
    {
        $this->expectException(\LogicException::class);

        $document = $this->createDocument(DocumentType::INSTRUCTION());

        $document->verify($this->verifier);
    }
}