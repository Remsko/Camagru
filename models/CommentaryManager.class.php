<?php

class CommentaryManager {

	public static function getCommentsByImageId($imageId) {
		$query = "SELECT * FROM comments WHERE imageid=:imageid ORDER BY id DESC";
		$values = ["imageid" => $imageId];
		Database::selectAllObject($query, $values, 'Commentary');
	}
}

?>