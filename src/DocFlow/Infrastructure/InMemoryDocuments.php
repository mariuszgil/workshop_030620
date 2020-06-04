<?php

namespace DocFlow\Infrastructure;

use DocFlow\Domain\Document;
use DocFlow\Domain\Documents;

class InMemoryDocuments implements Documents
{
    /**
     * @var Document[]
     */
    private $documents = [];

    public function get(string $number): Document
    {
        // if, czy istnieje...

        return $this->documents[$number];
    }

    public function getAll(): array
    {
        return array_values($this->documents);
    }

    public function save(Document $document): void
    {
        $this->documents[$document->getNumber()] = $document;
    }

    public function delete(string $number): void
    {
        unset($this->documents[$number]);
    }
}