<?php


namespace app\models;


class Contact extends databaseModels\Contact
{
    public function setFirstname(string $firstname): self
    {
        return $this;
    }

    public function setLastname(string $lastname): self
    {
        return $this;
    }

    public function setPhoneNumber($phoneNumber): self
    {
        return $this
    }
}