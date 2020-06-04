<?php

namespace DocFlow\Domain\NumberGenerator;

use DocFlow\Domain\Clock;
use DocFlow\Domain\DocumentType;
use DocFlow\Domain\NumberGenerator;

class ISO implements NumberGenerator
{
    /**
     * @var DocumentType
     */
    private $documentType;

    /**
     * @var Clock
     */
    private $clock;

    /**
     * ISO constructor.
     * @param DocumentType $documentType
     * @param Clock $clock
     */
    public function __construct(DocumentType $documentType, Clock $clock)
    {
        $this->documentType = $documentType;
        $this->clock = $clock;
    }

    public function generate(): string
    {
        return strtoupper($this->documentType->getValue()) . '/' . $this->clock->getDateTime()->format('Y/m/d/H/i/s');
    }
}