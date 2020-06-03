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
        // TODO: Implement get() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function save(Document $document): void
    {
        // TODO: Implement save() method.
    }

    public function delete(string $number): void
    {
        // TODO: Implement delete() method.
    }
}