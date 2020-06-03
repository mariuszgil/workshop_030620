<?php

namespace DocFlow\Domain\Clock;

use DocFlow\Domain\Clock;

class System implements Clock
{
    public function getDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}