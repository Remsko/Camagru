<?php

class ImageManager {

	public function getImages() {
		$images = Database::selectAllObject('SELECT * FROM images ORDER BY date DESC', [], 'Image');
		return $images;
	}
}

?>
