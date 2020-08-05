<?php
require_once  __DIR__ . '/../core/init.php';

use lib\{User, Session};

$user = new User();

include('includes/header.php');
?>
<h1 class="text-center my-5">PHP User Registration System</h1>

<?php
if (Session::get('logedIn')) {
    echo info(Session::flush('logedIn'), $class = 'alert-info');
}

include('includes/footer.php');
