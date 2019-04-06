<?php $this->_title = 'Reset Password'; ?>
<div id="container">
    <div><h1>Reset Password</h1></div>
    <div id="block">
    <form method="post" action="">
        <span>Email Address:</span><br />
        <input type="text" name="mail" value=""/><br /><br />

        <input class="button_class" type="submit" name="resetForm" value="Send" />
    </form>
    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>
    </div>
</div>