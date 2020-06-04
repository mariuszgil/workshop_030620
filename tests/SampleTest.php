<?php

use DocFlow\Domain\User;

class SampleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function foo()
    {
        $user = new User('foo');

        $this->assertEquals('foo', $user->getUsername());

        return $user;
    }

    /**
     * @test
     * @depends foo
     * // ostroznie z tym! najlepiej wcale...
     */
    public function bar(User $user)
    {
        $this->assertEquals('foo', $user->getUsername());
    }
}