<?php
require_once  __DIR__ . '/../core/init.php';

use lib\{User, Redirect, Input, Validate, Config, Token, Hash};

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
};

$userData = $user->getUserData();
$isChecked = Token::check(Input::get('token'));
$infoField = '';
$nameValue = $userData['name'];

if (Input::exists() && $isChecked) {
    $validate = new Validate();
    $validation = $validate->check($_POST, Config::get('change_login_rules'));
    $nameValue  = Input::get('name');
    if ($validation->isPassed()) {
        try {
            $user->update([
                'id' => $userData['id'],
                'name' => Input::get('name'),
                'password' => Hash::make(Input::get('password'))
            ]);
        } catch (Exception $e) {
            $infoField = info($e->getMessage());
        }
        $infoField = info('your data changed!', 'alert-success');
    } else {
        $warnings = $validation->getErrors();
        foreach ($warnings as $warning) {
            $infoField .= info($warning);
        }
    }
}



include('includes/profile_header.php');
echo "<h4 class='text-center mt-5'> Hello, {$nameValue },</br> you could change your name and password here.</h4>"
?>
<h1></h1>
<div class="card-body mx-5">
    <form class="mb-4" action="" method="post">

        <div class="form-group">
            <label for="login">Name</label>
            <input type="text" id="login" name="name" value="<?php echo escape($nameValue)?>" class="form-control form-control-lg" placeholder="Enter name">
        </div>

        <div class="form-group">
            <label for="Password1">Password</label>
            <input type="password" name="password" class="form-control form-control-lg" id="Password1" placeholder="Password">
        </div>
                
        <input type="submit" class="btn btn-primary" value="Change">
        <input type="hidden" name="token" value="<?php echo  Token::generate() ?>">
    </form>
    <?php
        echo $infoField;
    ?>
</div>

<?php
include('includes/footer.php');
?>
