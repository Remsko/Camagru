<div>
	<?php
		if ($image->getUserId() === $_SESSION['userId']) {
			echo '<button onclick="deletePicture(event);" data-imageid="'.$image->getId().'">Delete</button>';
		}
		?>
</div>
<img src="<?= $image->getPath() ?>"><br/>
<script src='/public/js/delete.js'></script>
<script src="/public/js/ajax.js"></script>