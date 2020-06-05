<?php

namespace DocFlow\Application;

use DocFlow\Domain\Documents;
use DocFlow\Domain\DocumentSigner;
use DocFlow\Domain\EventPublisher;

class DocFlowService
{
    /**
     * @var Documents
     */
    private $documents;
    /**
     * @var DocumentSigner
     */
    private $signer;
    /**
     * @var EventPublisher
     */
    private $publisher;

    /**
     * DocFlowService constructor.
     * @param Documents $documents
     * @param DocumentSigner $signer
     * @param EventPublisher $publisher
     */
    public function __construct(
        Documents $documents,
        DocumentSigner $signer,
        EventPublisher $publisher)
    {
        $this->documents = $documents;
        $this->signer = $signer;
        $this->publisher = $publisher;
    }

    public function publishDocument(string $number): void
    {
        $document = $this->documents->get($number);

        $document->publish($this->signer, $this->publisher);

        $this->documents->save($document);
    }

    public function archiveDocument(string $number): void
    {
        // Tylko na potrzeby wytlumaczenia koncepcji :)
        $document = $this->documents->get($number);

        $document->archive();

        $this->documents->save($document);
    }

    // ...
}