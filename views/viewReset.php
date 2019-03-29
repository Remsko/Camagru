<?php $this->_title = 'Reset'; ?>
<form>
    <span>Email Address:</span><br />
    <input type="text" name="mail" value=""/><br />

    <input type="submit" name="resetForm" value="Send" />
</form>
<?php
    if(isset($error)) {
        echo '<font color="red">'.$error."</font>";
    }
?>