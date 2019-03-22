<?php

class ImageManager {

	public function getImages() {
		$images = Database::selectAllObject('SELECT * FROM images ORDER BY id DESC', [], 'Image');
		return $images;
	}

	public static function getLikesByImageId($imageId) {
		$query = 'SELECT * FROM likes WHERE imageid=:imageId';
		$values = ['imageId' => $imageId];
		if ($stmt = Database::safeExecute($query, $values)) {
			return $stmt->rowCount();
		}
		return 0;
	}

	public static function isLiked($imageId) {
		if (isset($_SESSION['userId'])) {
			$userId = $_SESSION['userId'];
			$query = 'SELECT * FROM likes WHERE imageid=:imageId AND userid=:userId';
			$values = [
				'imageId' => $imageId,
				'userId' => $userId
			];
			if ($stmt = Database::safeExecute($query, $values)) {
				return $stmt->rowCount() ? true : false;
			}
		}
		return false;
	}
 }

?>
