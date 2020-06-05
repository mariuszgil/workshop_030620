<?php

namespace Tests\DocFlow\Acceptance\Services;

use DocFlow\Application\DocFlowService;
use DocFlow\Domain\Document;
use DocFlow\Domain\Documents;
use DocFlow\Domain\DocumentStatus;
use DocFlow\Domain\DocumentType;
use DocFlow\Infrastructure\InMemoryDocuments;
use DocFlow\Infrastructure\InMemoryPublisher;
use DocFlow\Infrastructure\InMemorySigner;
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
     * @var Document
     */
    private $document = null;

    /**
     * @var Document
     */
    private $document_new = null;

    /**
     * ServicesTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // dla uproszczenia, normalnie konfiguracja przez np. kontener DI
        $this->documents = new InMemoryDocuments();
        $this->service = new DocFlowService($this->documents, new InMemorySigner(), new InMemoryPublisher());
    }

    protected function givenNewDocumentIsCreated()
    {
        $this->document = $this->service->createDocument();
    }

    protected function whenNewVersionWasRequested()
    {
        $this->document_new = $this->service->createNewVersion($this->document->getNumber());
    }

    protected function thenExistingDocumentWasArchived()
    {
        $document = $this->documents->get($this->document->getNumber());
        $this->assertEquals(DocumentStatus::ARCHIVED(), $document->getStatus());
    }

    protected function thenNewVersionWasCreated()
    {
        $this->assertInstanceOf(Document::class, $this->documents->get($this->document_new->getNumber()));
        $this->assertNotEquals($this->document->getNumber(), $this->document_new->getNumber());
    }
}