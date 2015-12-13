<?php
namespace Site1;


interface IUserFinder
{
    /**
     * @param string $mail - email of the user
     * @return User
     */
    function FindUserByMail($mail);
}

