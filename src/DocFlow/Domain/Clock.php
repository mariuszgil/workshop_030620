<?php


namespace DocFlow\Domain;


interface Clock
{
    public function getDateTime(): \DateTimeImmutable;
}