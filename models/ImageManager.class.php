<?php

class ImageManager {

	public function getImages() {
		$images = Database::selectAllObject('SELECT * FROM images ORDER BY id DESC', [], 'Image');
		return $images;
	}

	public function getLikesByImageId($imageId) {
		$query = 'SELECT * FROM likes WHERE imageid=:imageId';
		$values = ['imageId' => $imageId];
		if ($stmt = Database::safeExecute($query, $values)) {
			return $stmt->rowCount();
		}
		return 0;
	}
}

?>
