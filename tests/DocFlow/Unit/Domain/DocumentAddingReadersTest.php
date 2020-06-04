<?php


namespace Tests\DocFlow\Unit\Domain;


use DocFlow\Domain\DocumentType;
use DocFlow\Domain\User;

class DocumentAddingReadersTest extends DocumentBase
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

        $document->addReader($user);
        $document->addReader($user);

        $this->assertTrue($document->isOnReadersList($user));
        $this->assertEquals($readersCount + 1, $document->getReadersCount());
    }

    /**
     * @dataProvider getReaders
     * @param User $reader
     */
    public function testSomeDefaultReadersAreAddedToList(User $reader)
    {
        $document = $this->createDocument(DocumentType::INSTRUCTION());
        $document->changeContent('title', 'content');
        $document->verify($this->verifier);

        $this->assertTrue($document->isOnReadersList($reader));
    }

    public function getReaders(): array
    {
        return [
            'Author must be on the list' => [new User('author')],
            'Verifier must be on the list' => [new User('verifier')]
        ];
    }

    /**
     * @group dumper
     */
    public function testX()
    {
        $document = $this->createDocument(DocumentType::INSTRUCTION());
        $user = new User('reader');

        $document->addReader($user);
        $document->changeContent('t', 'c');
        $document->verify($this->verifier);

        //
        foreach ($document->getReaders() as $reader) {
            var_dump($reader->getUsername());
        }
        //

        $this->assertTrue($document->isOnReadersList($user));
    }
}