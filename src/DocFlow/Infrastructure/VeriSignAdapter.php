<?php


namespace DocFlow\Infrastructure;


use DocFlow\Domain\DocumentSigner;
use DocFlow\Domain\User;

class VeriSignAdapter implements DocumentSigner
{
    public function sign(User $author, string $number): bool
    {
        // TODO: Implement sign() method.
    }
}