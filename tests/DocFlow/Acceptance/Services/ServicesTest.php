<?php

namespace Tests\DocFlow\Acceptance\Services;

use DocFlow\Application\DocFlowService;
use DocFlow\Domain\Documents;
use DocFlow\Infrastructure\InMemoryDocuments;
use Tests\DocFlow\Acceptance\GeneratingDocumentNewVersionTest;

class ServicesTest extends GeneratingDocumentNewVersionTest
{
    /**
     * @var DocFlowService
     */
    private $service;

    /**
     * @var Documents
     */
    private $documents;

    /**
     * ServicesTest constructor.
     */
    public function __construct()
    {
        // dla uproszczenia, normalnie konfiguracja przez np. kontener DI
        $this->documents = new InMemoryDocuments();
        $this->service = new DocFlowService(...);
    }

    protected function givenNewDocumentIsCreated()
    {
        // TODO: Implement givenNewDocumentIsCreated() method.
    }

    protected function whenArchiveWasRequested()
    {
        // TODO: Implement whenArchiveWasRequested() method.
    }

    protected function thenExistingDocumentWasArchived()
    {
        // TODO: Implement thenExistingDocumentWasArchived() method.
    }

    protected function thenNewVersionWasCreated()
    {
        // TODO: Implement thenNewVersionWasCreated() method.
    }
}