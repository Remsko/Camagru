<?php $this->_title = 'Settings'; ?>
<h1>Edit profil</h1>

<form method="post" action="">
    <span>Username: </span><br />
    <input type="text" name="username" value="<?= $user->getUsername() ?>" /><br />

    <span>Email address: </span><br />
    <input type="text" name="mail" value="<?= $user->getMail() ?>"/><br />

    <span>Notifications</span>
    <input type='checkbox' name='notifications' checked='checked' />
    <br />

    <input type='submit' name='editProfil' value='Send' />
</form>
<?php
    if(isset($error)) {
        echo '<font color="red">'.$error."</font>";
    }
?>