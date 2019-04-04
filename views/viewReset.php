<?php $this->_title = 'Reset Password'; ?>
<div id="container">
    <div><h1>Reset Password</h1></div>
    <div id="block">
    <form method="post" action="">
        <span>Email Address:</span><br />
        <input type="text" name="mail" value=""/><br />

        <input type="submit" name="resetForm" value="Send" />
    </form>
    <?php
        if(isset($error)) {
            echo '<font color="red">'.$error."</font>";
        }
    ?>
    </div>
</div>