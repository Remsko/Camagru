<?php $this->_title = 'Sign Up'; ?>
<div id="container">
    <div><h1>Sign up</h1></div>
    <div id="block">
        <form method="post" action="">
            <span>Username: </span><br />
            <input type="text" name="username"/><br />

            <span>Email Address: </span><br />
            <input type="text" name="mail"/><br />

            <span>Confirm Email Address: </span><br />
            <input type="text" name="mailConfirm"/><br />

            <span>Password: </span><br />
            <input type="password" name="password"/><br />

            <span>Confirm Password: </span><br />
            <input type="password" name="passwordConfirm"/><br /><br />

            <input class="button_class" type="submit" name="signUpForm" value="Send" />
        </form><br/>
        <?php
            if(isset($message)) {
               echo $message;
            }
        ?>
    </div>
</div>