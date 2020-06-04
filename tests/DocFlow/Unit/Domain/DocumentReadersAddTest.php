<?php


namespace Tests\DocFlow\Unit\Domain;


use DocFlow\Domain\DocumentType;
use DocFlow\Domain\User;

class DocumentReadersAddTest extends DocumentBaseTest
{
    public function testCanAddNewUser()
    {
        $document = $this->createDocument(DocumentType::INSTRUCTION());
        $user = new User('reader');

        $document->addReader($user);

        $this->assertTrue($document->isOnReadersList($user));
    }

    public function testCanAddSameUserMultipleTimes()
    {
        $document = $this->createDocument(DocumentType::INSTRUCTION());
        $user = new User('reader');
        $readersCount = $document->getReadersCount();

//        $document->addReader($user);
//        $document->addReader($user);
        $document->addReader($document->getAuthor());
        $document->addReader($document->getAuthor());

        $this->assertTrue($document->isOnReadersList($user));
        $this->assertEquals($readersCount + 1, $document->getReadersCount());
    }
}