<?php


namespace Tests\DocFlow\Unit\Domain\NumberGenerator;


use DocFlow\Domain\NumberGenerator;
use DocFlow\Domain\NumberGenerator\PrefixedNumberGenerator;
use PHPUnit\Framework\TestCase;

class PrefixedTest extends TestCase
{
    public function testPrefixedNumber()
    {
        $numberGenerator = $this->prophesize(NumberGenerator::class);
        $numberGenerator->generate()->willReturn("abc");
        $prefix = 'DEMO';
        $generator = new PrefixedNumberGenerator($numberGenerator->reveal(), $prefix);

        $prefixedNumber = $generator->generate();

        $this->assertStringStartsWith($prefix, $prefixedNumber);
    }
}