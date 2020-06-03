<?php

namespace Tests\DocFlow\Unit\Domain;

use DocFlow\Domain\Clock\Fixed;
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
        $clock = new Fixed(new \DateTimeImmutable('2020-06-03 14:00:00'));
        $number = $type . '/' . $clock->getDateTime()->format('Y/m/d');
        $document = new Document($type, $author, $clock); // ups, tu jest problem z czasem, zmienia sie

        // Assert / Then
        $this->assertEquals(DocumentStatus::DRAFT(), $document->getStatus());
        $this->assertEquals($type, $document->getType());
        $this->assertEquals($author, $document->getAuthor());
        $this->assertEquals($number, $document->getNumber());
    }

    public function test2() // ta nazwa jest masakryczna...
    {
        $this->expectException(\LogicException::class);

        throw new \LogicException();
    }
}