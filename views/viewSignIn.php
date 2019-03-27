<?php $this->_title = 'Sign In'; ?>
<div id="container">
    <div><h1>Sign in</h1><div>
    <div id="block">
        <form method="post" action="">
            <span>Username:<span><br />
            <input type="text" name="username" value="<?php if (isset($username)) { echo $username; } ?>" /><br />

            <span>Password:</span><br />
            <input type="password" name="password" value="" /><br />

            <input type="submit" name="signInForm" value="Sign In" />
        </form>
        <?php
            if(isset($error)) {
               echo '<font color="red">'.$error."</font>";
            }
        ?>
    </div>
</div>