<?php
function info($messasge, $class = 'alert-danger')
{
    return  "<div class='alert {$class}'>{$messasge}</div>";
}

function KeepPreviousIfNotSpecified($newValue, $oldValue)
{
    return ($newValue) ? $newValue : $oldValue;
}

function escape($string)
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
