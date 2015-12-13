<?php
namespace Site1;


interface IUserDao
{
    /**
     * @param string $mail
     * @return User
     */
    function FindUserByMail($mail);

    function SaveUser(User $user);
}

