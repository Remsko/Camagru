<?php

class ImageManager {

	public function getImages() {
		$images = Database::selectAllObject('SELECT * FROM images ORDER BY id DESC', [], 'Image');
		return $images;
	}

	
}

?>
