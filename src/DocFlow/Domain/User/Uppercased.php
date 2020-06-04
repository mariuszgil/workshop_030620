<?php

namespace DocFlow\Domain\User;

use DocFlow\Domain\IUser;

class Uppercased implements IUser
{
    /**
     * @var IUser
     */
    private $user;

    /**
     * Uppercased constructor.
     * @param IUser $user
     */
    public function __construct(IUser $user)
    {
        $this->user = $user;
    }

    public function getUsername(): string
    {
        return strtoupper($this->user->getUsername());
    }
}