<div>
	<?php
		if (isset($_SESSION['userId']) && $image->getUserId() === $_SESSION['userId']) {
			echo '<button class="button_delete" onclick="deletePicture(event);" data-imageid="'.$image->getId().'">Delete</button>';
		}
	?>
</div>
<center><img class="gallery" src="<?= $image->getPath() ?>"/></center>