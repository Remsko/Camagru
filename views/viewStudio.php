<?php $this->_title = 'Studio'; ?>

<?php
    if (isset($_SESSION['userId'])) {
		require_once('layout/camera.php');
    }
    else {
        echo '<font color="red">'.'You must be logged in to access the studio.'."</font>";
	}
?>
