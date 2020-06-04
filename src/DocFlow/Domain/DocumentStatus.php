<?php

namespace DocFlow\Domain;

use MyCLabs\Enum\Enum;

class DocumentStatus extends Enum
{
    public const DRAFT  = 'draft';
    public const VERIFIED  = 'verified';
    public const PUBLISHED = 'published';
    public const ARCHIVED = 'archived';

    // ...
}