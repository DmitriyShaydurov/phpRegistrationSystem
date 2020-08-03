<?php
namespace lib;

class Token
{
    public static function generate()
    {
        return Session::set(Config::get('session/token_name'), md5(uniqid(true)));
    }

    public static function check($token)
    {
        $tokenName = Config::get('session/token_name');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}
