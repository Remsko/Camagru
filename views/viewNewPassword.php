<?php $this->_title = 'New Password'; ?>
<form method="post" action="">
    <span>Password: </span><br />
    <input type="password" name="password" value=""/><br />

    <span>Confirm Password: </span><br />
    <input type="password" name="passwordConfirm" value=""/><br />

    <input type="submit" name="newPasswordForm" value="Send" />
</form>
<?php
    if(isset($error)) {
        echo '<font color="red">'.$error."</font>";
    }
?>