<?php

namespace DocFlow\Infrastructure;

use DocFlow\Domain\Document;
use DocFlow\Domain\Documents;

class PDODocuments implements Documents
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * PDODocuments constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get(string $number): Document
    {

    }

    /**
     * @return Document[]
     */
    public function getAll(): array
    {

    }

    public function save(Document $document): void
    {

    }

    public function delete(string $number): void
    {

    }
}