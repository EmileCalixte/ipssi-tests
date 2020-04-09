<?php


namespace Test;


use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @var User $user */
    private $user;

    public function setUp(): void
    {
        $this->user = new User('good@email.com', 'André', 'Gazon', 24);
    }

    public function tearDown(): void
    {
        unset($this->user);
    }

    public function testIsValid()
    {
        $this->assertTrue($this->user->isValid());

        $this->user->setEmail('bademail');
        $this->assertFalse($this->user->isValid());
        $this->user->setEmail('good@email.com');

        $this->user->setFirstname('');
        $this->assertFalse($this->user->isValid());
        $this->user->setFirstname('André');

        $this->user->setLastname('');
        $this->assertFalse($this->user->isValid());
        $this->user->setLastname('Gazon');

        $this->user->setAge(11);
        $this->assertFalse($this->user->isValid());
        $this->user->setAge(24);
    }
}