<?php

class CommentaryManager {

	public static function getCommentsByImageId($imageId) {
		$query = "SELECT * FROM comments WHERE imageid=:imageid ORDER BY id ASC";
		$values = ["imageid" => $imageId];
		return Database::selectAllObject($query, $values, 'Commentary');
	}
}

?>