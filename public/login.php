<?php
require_once  __DIR__ . '/../core/init.php';

use lib\{Input, Token, Validate, Config, Session, User, Redirect};

$infoField = '';

$user = new User();
if ($user->isLoggedIn()) {
    Session::flush('logedIn', 'You are already logged in! <a href="profile.php" class="alert-link">Visit you profile page</a>');
    Redirect::to('index.php');
}


$isChecked = Token::check(Input::get('token'));
$infoField = '';

if (Input::exists() && $isChecked) {
    $validate = new Validate();
    $validation = $validate->check($_POST, Config::get('login_rules'));
    
    if ($validation->isPassed()) {
        $user = new User();
        $login = $user->login(Input::get('login'), Input::get('password'));
        if ($login) {
            Redirect::to('profile.php');
        } else {
            $infoField = info('wrong password');
        }
    } else {
        $warnings = $validation->getErrors();
        foreach ($warnings as $warning) {
            $infoField .= info($warning);
        }
    }
}


include('includes/header.php');
?>

<div class="card-body mx-5">
    <form class="mb-4" action="" method="post">

        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" value="<?php echo escape(Input::get('login'))?>" class="form-control form-control-lg" placeholder="Enter name">
        </div>

        <div class="form-group">
            <label for="Password1">Password</label>
            <input type="password" name="password" class="form-control form-control-lg" id="Password1" placeholder="Password">
        </div>
                
        <input type="submit" class="btn btn-primary" value="Log in">
        <input type="hidden" name="token" value="<?php echo  Token::generate() ?>">
    </form>
    <?php
        echo $infoField;
    ?>
</div>

<?php
include('includes/footer.php');
?>