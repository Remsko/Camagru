<?php

class ImageManager {

	public function getImages() {
		$images = Database::selectAllObject('SELECT * FROM images ORDER by id desc', [], 'Image');
		return $images;
	}
}

?>
