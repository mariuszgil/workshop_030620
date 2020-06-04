<?php

namespace DocFlow\Domain\User;

use DocFlow\Domain\IUser;

class Anonymized implements IUser
{
    /**
     * @var IUser
     */
    private $user;

    /**
     * @var int
     */
    private $length;

    /**
     * An
     * constructor.
     * @param IUser $user
     * @param int $length
     */
    public function __construct(IUser $user, int $length = 3)
    {
        $this->user = $user;
        $this->length = $length;
    }

    public function getUsername(): string
    {
        return substr($this->user->getUsername(), 0, $this->length) . '.';
    }
}