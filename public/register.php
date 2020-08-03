<?php
require_once  __DIR__ . '/../core/init.php';

use lib\{Input, Token, Validate, Config, User, Hash, Redirect, Session};

$user = new User();
if ($user->isLoggedIn()) {
    Session::flush('logedIn', 'You are already logged in! <a href="profile.php" class="alert-link">Visit you profile page</a>');
    Redirect::to('index.php');
}

$isChecked = Token::check(Input::get('token'));
$infoField = '';

if (Input::exists() && $isChecked) {
    $validate = new Validate();
    $validation = $validate->check($_POST, Config::get('register_rules'));

    if ($validation->isPassed()) {
        $user = new User();
        try {
            $user->create([
                'name' => Input::get('name'),
                'login' => Input::get('login'),
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password'))
            ]);
        } catch (Exception $e) {
            $infoField = info($e->getMessage());
        }
        $infoField = ($infoField) ?  $infoField : info('You are successfully registered', 'alert-success');
    } else {
        $warnings = $validation->getErrors();
        foreach ($warnings as $warning) {
            $infoField .= info($warning);
        }
    }
}
include('includes/header.php')
?>

<div class="card-body mx-5">
    <form class="mb-4" action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo escape(Input::get('name'))?>" class="form-control form-control-lg" placeholder="Enter name">
        </div>

        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" value="<?php echo escape(Input::get('login'))?>" class="form-control form-control-lg" placeholder="Enter name">
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?php echo escape(Input::get('email'))?>" placeholder="Enter email">
            <small class="form-text text-muted">Your email will not be shared with anyone</small>
        </div>

        <div class="form-group">
            <label for="Password1">Password</label>
            <input type="password" name="password" class="form-control form-control-lg" id="Password1" placeholder="Password">
        </div>
                
        <input type="submit" class="btn btn-primary" value="Register">
        <input type="hidden" name="token" value="<?php echo  Token::generate() ?>" >
    </form>
    <?php
        echo $infoField;
    ?>
</div>

<?php
include('includes/footer.php')
?>