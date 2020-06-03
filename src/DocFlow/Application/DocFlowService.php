<?php

namespace DocFlow\Application;

use DocFlow\Domain\Documents;

class DocFlowService
{
    /**
     * @var Documents
     */
    private $documents;

    /**
     * DocFlowService constructor.
     * @param Documents $documents
     */
    public function __construct(Documents $documents)
    {
        $this->documents = $documents;
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