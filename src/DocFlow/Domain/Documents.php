<?php

namespace DocFlow\Domain;

interface Documents
{
    public function get(string $number): Document;

    /**
     * @return Document[]
     */
    public function getAll(): array;

    public function save(Document $document): void;

    public function delete(string $number): void;
}