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
        $type = DocumentType::INSTRUCTION();
        $number = $type . '/' . date('Y/m/d');
        $document = new Document($type, $author); // ups, tu jest problem z czasem, zmienia sie

        // Assert / Then
        $this->assertEquals(DocumentStatus::DRAFT(), $document->getStatus());
        $this->assertEquals($type, $document->getType());
        $this->assertEquals($author, $document->getAuthor());
        $this->assertEquals($number, $document->getNumber());
    }
}