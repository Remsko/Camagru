<?php $this->_title = 'Settings'; ?>

<h1>Edit profile</h1>
<form method="post" action="">
    <span>Username: </span><br />
    <input type="text" name="username" value="<?= $user->getUsername() ?>" /><br />

    <span>Email Address: </span><br />
    <input type="text" name="mail" value="<?= $user->getMail() ?>"/><br />

    <span>Notifications</span>
    <?php
        if ($user->getNotifications()) {
            echo '<input type="checkbox" name="notifications" checked="checked" />';
        }
        else {
            echo '<input type="checkbox" name="notifications" />';
        }
    ?><br />

    <input type='submit' name='editProfile' value='Send' />
</form>

<h1>Change Password</h1>
<form method="post" action="">
    <span>Old Password: </span><br />
    <input type="password" name="oldPassword" value="" /><br />

    <span>New Password: </span><br />
    <input type="password" name="newPassword" value="" /><br />

    <span>Confirm New Passord: </span><br />
    <input type="password" name="confirmNewPassword" value="" /><br />

    <input type='submit' name='changePassword' value='Send' />
</form>

<?php
    if(isset($error)) {
        echo '<font color="red">'.$error."</font>";
    }
?>