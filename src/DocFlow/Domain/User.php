<?php

namespace DocFlow\Domain;

class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * User constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public function equals(User $other): bool
    {
        return $this->username == $other->getUsername();
    }
}