<?php


namespace DocFlow\Infrastructure;


use DocFlow\Domain\DocumentSigner;
use DocFlow\Domain\User;

class InMemorySigner implements DocumentSigner
{

    public function sign(User $author, string $number): void
    {
        // TODO: Implement sign() method.
    }
}