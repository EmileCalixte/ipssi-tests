<?php


namespace App;


class User
{
    /** @var string $email */
    private $email;

    /** @var string $firstname */
    private $firstname;

    /** @var string $lastname */
    private $lastname;

    /** @var int $age */
    private $age;

    public function __construct(string $email, string $firstname, string $lastname, int $age)
    {
        $this->setEmail($email);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setAge($age);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname(string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname(string $lastname): User
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return User
     */
    public function setAge(int $age): User
    {
        $this->age = $age;
        return $this;
    }

    public function isValid(): bool
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if(empty($this->firstname)) {
            return false;
        }

        if(empty($this->lastname)) {
            return false;
        }

        if($this->age < 13) {
            return false;
        }

        return true;
    }
}