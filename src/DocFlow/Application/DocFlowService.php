<?php

namespace DocFlow\Application;

use DocFlow\Domain\Clock\System;
use DocFlow\Domain\Document;
use DocFlow\Domain\Documents;
use DocFlow\Domain\DocumentSigner;
use DocFlow\Domain\DocumentType;
use DocFlow\Domain\EventPublisher;
use DocFlow\Domain\User;

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

    /**
     * @return Document
     */
    public function createDocument(): Document
    {
        $document = new Document(DocumentType::INSTRUCTION(), new User('Staszek'), new System());
        $this->documents->save($document);

        return $document;
    }

    /**
     * @param string $number
     * @return Document
     */
    public function createNewVersion(string $number): Document
    {
        $document = $this->documents->get($number);
        $this->archiveDocument($document->getNumber());

        $document_new = new Document($document->getType(), $document->getAuthor(), new System());
        $document_new->changeContent($document->getTitle(), $document->getContent());
        $this->documents->save($document_new);

        return $document_new;
    }
}