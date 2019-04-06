<?php $this->_title = 'New Password'; ?>
<div id="container">
    <div><h1>New Password</h1></div>
    <div id="block">
        <form method="post" action="">
            <span>Password: </span><br />
            <input type="password" name="password" value=""/><br />

            <span>Confirm Password: </span><br />
            <input type="password" name="passwordConfirm" value=""/><br /><br />

            <input class="button_class" type="submit" name="newPasswordForm" value="Send" />
        </form>
        <?php
            if(isset($message)) {
                echo $message;
            }
        ?>
    </div>
</div>