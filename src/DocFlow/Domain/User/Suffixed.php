<?php

namespace DocFlow\Domain\User;

use DocFlow\Domain\IUser;

class Suffixed implements IUser
{
    /**
     * @var IUser
     */
    private $user;
    /**
     * @var string
     */
    private $suffix;

    /**
     * Suffixed constructor.
     * @param IUser $user
     * @param string $suffix
     */
    public function __construct(IUser $user, string $suffix)
    {
        $this->user = $user;
        $this->suffix = $suffix;
    }

    public function getUsername(): string
    {
        return strtoupper($this->user->getUsername()) . ' (' . $this->suffix . ')';
    }
}