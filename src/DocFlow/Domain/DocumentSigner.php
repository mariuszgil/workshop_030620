<?php


namespace DocFlow\Domain;


interface DocumentSigner
{
    public function sign(User $author, string $number): void;
}