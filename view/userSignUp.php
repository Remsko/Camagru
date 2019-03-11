<?php

function checkSignUpForm()
{
    if (empty($_POST['username']) || empty($_POST['mail']) || empty($_POST['mailConfirm'])
        || empty($_POST['password']) || empty($_POST['passwordConfirm'])) {
        return 'All fields need to be completed !';
    }
    $username = htmlspecialchars($_POST['username']);
    $mail = htmlspecialchars($_POST['mail']);
    $mailConfirm = htmlspecialchars($_POST['mailConfirm']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if (strlen($username) > 15) {
        return 'Username is too long !';
    }
    if ($mail != $mailConfirm) {
        return 'Email addresses does not match !';
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return 'Email is not valid';
    }
    if (strlen($mail) > 30) {
        return 'Email is too long !';
    }
    if (!password_verify($_POST['passwordConfirm'], $password)) {
        return 'Passwords does not match !';
    }
    if (strlen($_POST['password']) > 20) {
        return 'Password is too long !';
    }
    if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$#', $_POST['password'])) {
        return 'Password must contain minimum eight characters, at least one uppercase letter, one lowercase letter and one number !';
    }
    return null;
}

if (isset($_POST['signUpForm']))
{
    $error = checkSignUpForm();
    if (!$error) {
        echo '<span>Your account has been created !</span><br />';
    }
}

?>

<div id="container">
    <div><h1>Sign up</h1><div>
    <div id="block">
        <form method="post" action="">
            <span>Username: </span><br />
            <input type="text" name="username" value="<?php if (isset($username)) { echo $username; } ?>" /><br />

            <span>Email address: </span><br />
            <input type="text" name="mail" value="<?php if (isset($mail)) { echo $mail; } ?>"/><br />

            <span>Email address confirmation: </span><br />
            <input type="text" name="mailConfirm" value="<?php if (isset($mailConfirm)) { echo $mailConfirm; } ?>"/><br />

            <span>Password: </span><br />
            <input type="password" name="password" value=""/><br />

            <span>Password confirmation: </span><br />
            <input type="password" name="passwordConfirm" value=""/><br />

            <input type="submit" name="signUpForm" value="Sign up">
        </form>
        <?php
            if(isset($error)) {
               echo '<font color="red">'.$error."</font>";
            }
        ?>
    </div>
</div>