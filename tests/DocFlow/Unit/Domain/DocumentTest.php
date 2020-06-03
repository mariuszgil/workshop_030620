<?php

namespace Tests\DocFlow\Unit\Domain;

use DocFlow\Domain\Document;
use DocFlow\Domain\DocumentStatus;
use DocFlow\Domain\DocumentType;
use DocFlow\Domain\User;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    /**
     * @test
     */
    public function test()
    {
        // Arrange / Given
        // Act / When
        $author = new User();
        $document = new Document(DocumentType::INSTRUCTION(), $author);

        // Assert / Then
        $this->assertEquals(DocumentStatus::DRAFT(), $document->getStatus());
    }
}