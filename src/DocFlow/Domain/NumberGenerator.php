<?php

namespace DocFlow\Domain;

interface NumberGenerator
{
    /**
     * @return string
     *
     * Tutaj jest bardzo istotne pytanie o sygnature ponizszej metody...
     */
    public function generate(): string;
}