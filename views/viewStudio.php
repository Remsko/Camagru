<?php $this->_title = 'Studio'; ?>

<?php
    if (isset($_SESSION['userId'])) {
		require_once('layout/camera.php');
?>
<div id='imgContainer'>
<?php		foreach ($images as $image) {
			require('layout/oldpics.php');
		}
?>
</div>
<?php
    }
    else {
        echo '<font color="red">'.'You must be logged in to access the studio.'."</font>";
	}
?>
