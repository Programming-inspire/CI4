<?php

namespace App\Libraries;

class Hash
{
    //Encrypt user Password
    public static function encrypt($Password)
    {
        return password_hash($Password, PASSWORD_BCRYPT);
    }


    //checking user password with DB
    public static function check($userPassword, $dbUserPassword)
    {
        if(password_verify($userPassword, $dbUserPassword))
        {
            return true;
        }
        return false;
    }
}