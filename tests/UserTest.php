<?php


namespace Test;


use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsValid()
    {
        $user = new User('good@email.com', 'André', 'Gazon', 24);
        $this->assertTrue($user->isValid());

        $user = new User('bademail', 'André', 'Gazon', 24);
        $this->assertFalse($user->isValid());

        $user = new User('good@email.com', '', 'Gazon', 24);
        $this->assertFalse($user->isValid());

        $user = new User('good@email.com', 'André', '', 24);
        $this->assertFalse($user->isValid());

        $user = new User('good@email.com', 'André', 'Gazon', 11);
        $this->assertFalse($user->isValid());
    }
}