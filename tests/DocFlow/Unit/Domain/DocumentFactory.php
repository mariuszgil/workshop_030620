<?php


namespace Tests\DocFlow\Unit\Domain;


use DocFlow\Domain\Clock\Fixed;
use DocFlow\Domain\Document;
use DocFlow\Domain\DocumentType;
use DocFlow\Domain\User;

class DocumentFactory
{
    public function createDraft(): Document
    {
        return new Document(
            DocumentType::INSTRUCTION(),
            new User('author'),
            new Fixed(new \DateTimeImmutable('2020-06-04 10:00:00'))
        );
    }

    public function createVerified(): Document
    {
        $document = $this->createDraft();

        $document->changeContent('title', 'content');
        $document->verify(new User('verifier'));

        return $document;
    }

    public function createArchived(): Document
    {
        $document = $this->createDraft();

        $document->archive();

        return $document;
    }
}