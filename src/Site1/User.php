<?php
namespace Site1;


class User
{
    public $pass;
    public $mail;
    public $id = null;

    public function __construct($mail, $pw)
    {
        // note pdoFetchObject injects values before constructor
        // hence |PDO::FETCH_PROPS_LATE in fetchObject
        $this->mail = $mail;
        $this->pass = $pw;
    }
}