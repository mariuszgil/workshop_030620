<?php

namespace DocFlow\Domain\Clock;

use DocFlow\Domain\Clock;

class Fixed implements Clock
{
    /**
     * @var \DateTimeImmutable
     */
    private $dateTime;

    /**
     * Fixed constructor.
     * @param \DateTimeImmutable $dateTime
     */
    public function __construct(\DateTimeImmutable $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function getDateTime(): \DateTimeImmutable
    {
        return $this->dateTime;
    }
}