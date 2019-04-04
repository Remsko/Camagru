<?php $this->_title = 'Sign In'; ?>
<div id="container">
    <div><h1>Sign in</h1></div>
    <div id="block">
        <form method="post" action="">
            <span>Username:<span><br />
            <input type="text" name="username"/><br />

            <span>Password:</span><br />
            <input type="password" name="password"/><br />

            <input type="submit" name="signInForm" value="Send" />
        </form><br/>
        <a href="/user/reset">Forgot your password ?</a><br/><br/>
        <?php
            if(isset($error)) {
               echo '<font color="red">'.$error."</font>";
            }
        ?>
    </div>
</div>