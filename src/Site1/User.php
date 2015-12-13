<?php
namespace Site1;


class User
{
    public $password;
    public $email;

    public function __construct($email, $pw)
    {
        $this->email = $email;
        $this->password = $pw;
    }
}