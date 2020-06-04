<?php

namespace DocFlow\Domain;

interface IUser
{
    /**
     * @return string
     */
    public function getUsername(): string;
}