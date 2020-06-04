<?php

namespace Tests\DocFlow\Unit\Domain\NumberGenerator;

use DocFlow\Domain\Clock\Fixed;
use DocFlow\Domain\DocumentType;
use DocFlow\Domain\NumberGenerator\ISO;

class ISOTest extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $generator = new ISO(
            DocumentType::INSTRUCTION(),
            new Fixed(new \DateTimeImmutable('2020-06-04 10:00:00'))
        );

        $number = $generator->generate();

        $this->assertEquals('INSTRUCTION/2020/06/04/10/00/00', $number);
    }
}