<?php $this->_title = 'Sign Up'; ?>
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

            <input type="submit" name="signUpForm" value="Sign up" />
        </form>
        <?php
            if(isset($error)) {
               echo '<font color="red">'.$error."</font>";
            }
        ?>
    </div>
</div>