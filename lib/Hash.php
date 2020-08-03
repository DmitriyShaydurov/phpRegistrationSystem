<?php
namespace lib;

class Hash
{
    public static function make($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function isVerified($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
