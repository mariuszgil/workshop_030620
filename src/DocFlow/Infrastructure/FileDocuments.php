<?php

namespace DocFlow\Infrastructure;

use DocFlow\Domain\Document;
use DocFlow\Domain\Documents;

class FileDocuments implements Documents
{
    /**
     * @var string
     */
    private $path;

    /**
     * FileDocuments constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

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