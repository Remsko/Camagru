<?php

class ImageManager {

	public function getImages() {
		$images = Database::selectAllObject('SELECT * FROM images ORDER BY id DESC', [], 'Image');
		return $images;
	}

	public function getImagesFromStart($limit, $offset) {
		$query = 'SELECT * FROM images ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;
		$values = [];
		$images = Database::selectAllObject($query, $values, 'Image');
		return $images;
	}

	public function getImagesByUserId($userId) { 
		$query = 'SELECT * FROM images WHERE userid=:userid ORDER BY id DESC LIMIT 5';
		$values = ['userid' => $userId];
		$images = Database::selectAllObject($query, $values, 'Image');
		return $images;
	}

	public static function getByImageId($imageId) {
		$query = 'SELECT * FROM images WHERE id=:imageId';
		$values = ['imageId' => $imageId];
		return Database::selectOneObject($query, $values, 'Image');
	}

	public static function getLikesByImageId($imageId) {
		$query = 'SELECT * FROM likes WHERE imageid=:imageId';
		$values = ['imageId' => $imageId];
		if ($stmt = Database::safeExecute($query, $values)) {
			return $stmt->rowCount();
		}
		return 0;
	}

	public static function pushImage($image) {
		$query = 'INSERT INTO images(userid, path) VALUES(:userid, :path)';
		$values = [
			'userid' => $image->getUserId(),
			'path' => $image->getPath()
		];
		return Database::safeExecute($query, $values);
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

	public function dislike($userId, $imageId) {
		$query = 'DELETE FROM likes WHERE userid=:userId AND imageid=:imageId';
		$values = [
			'userId' => $userId,
			'imageId' => $imageId
		];
		return Database::safeExecute($query, $values);
	}

	public function like($userId, $imageId) {
		$query = 'INSERT INTO likes(userid, imageid) VALUES(:userId, :imageId)';
		$values = [
			'userId' => $userId,
			'imageId' => $imageId
		];
		return Database::safeExecute($query, $values);
	}
 }

?>
