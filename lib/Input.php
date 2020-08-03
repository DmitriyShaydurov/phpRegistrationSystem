<?php
namespace lib;

class Input
{
    public static function exists($type = 'post')
    {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
            case 'get':
                return (!empty($_GET)) ? true : false;
            default:
                return false;
        }
    }

    public static function get($item)
    {
        if (isset($_POST[$item])) {
            return ($_POST[$item]);
        }
        if (isset($_GET[$item])) {
            return ($_GET[$item]);
        }
        return '';
    }
}