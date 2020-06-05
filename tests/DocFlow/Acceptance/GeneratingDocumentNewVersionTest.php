<?php

namespace Tests\DocFlow\Acceptance;

use PHPUnit\Framework\TestCase;

abstract class GeneratingDocumentNewVersionTest extends TestCase
{
    public function test()
    {
        $this->givenNewDocumentIsCreated();
        $this->whenArchiveWasRequested();
        $this->thenExistingDocumentWasArchived();
        $this->thenNewVersionWasCreated();
    }

    abstract protected function givenNewDocumentIsCreated();

    abstract protected function whenArchiveWasRequested();

    abstract protected function thenExistingDocumentWasArchived();

    abstract protected function thenNewVersionWasCreated();
}