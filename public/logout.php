<?php
require_once  __DIR__ . '/../core/init.php';

use lib\{User,Redirect};

$user = new User();
$user->logout();
Redirect::to('index.php');
