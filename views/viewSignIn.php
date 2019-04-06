<?php $this->_title = 'Sign In'; ?>
<div id="container">
    <div><h1>Sign in</h1></div>
    <div id="block">
        <form method="post" action="">
            <span>Username:<span><br />
            <input type="text" name="username"/><br />

            <span>Password:</span><br />
            <input type="password" name="password"/><br /><br />

            <input class="button_class" type="submit" name="signInForm" value="Send" />
        </form><br/><br/>
        <a  href="/user/reset"><span>Forgot your password ?</span></a><br/><br/>
        <?php
            if(isset($message)) {
               echo $message;
            }
        ?>
    </div>
</div>