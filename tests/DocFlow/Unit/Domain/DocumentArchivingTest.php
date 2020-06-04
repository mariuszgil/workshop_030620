<?php

namespace Tests\DocFlow\Unit\Domain;

use DocFlow\Domain\Document;
use DocFlow\Domain\DocumentStatus;

class DocumentArchivingTest extends DocumentBase
{
    /**
     * @dataProvider getDocumentsToArchive
     * @param Document $document
     */
    public function test(Document $document)
    {
        $document->archive();

        $this->assertEquals(DocumentStatus::ARCHIVED(), $document->getStatus());
    }

    public function getDocumentsToArchive(): array
    {
        $factory = new DocumentFactory();

        return [
            [$factory->createDraft()],
            [$factory->createVerified()],
        ];
    }
}