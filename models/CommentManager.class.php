<?php

class CommentManager {
	private $_comment;

	public function checkCommentForm() {
		$userId = $_SESSION['userId'];
		$imageId = $_POST['imageId'];
		$content = $_POST['comment'];

		if (empty($userId) || empty($imageId) || empty($content)) {
			return ' ';
		}
		if (strlen($content) > 300) {
			return 'Comment is too long !';
		}
		return null;
	}

	public function postComment() {
		if ($error = $this->checkCommentForm()) {
            return $error;
		}
		
		$userId = $_SESSION['userId'];
		$imageId = htmlspecialchars($_POST['imageId']);
		$content = htmlspecialchars($_POST['comment']);

		$this->_comment = new Comment([
			'userId' => $userId,
			'imageId' => $imageId,
			'content' => $content
		]);

		$this->pushComment();
	}
	
	private function pushComment() {
		$query = 'INSERT INTO comments(userid, imageid, content) VALUES(:userId, :imageId, :content)';
		$values = [
			'userId' => $this->_comment->getUserId(),
			'imageId' => $this->_comment->getImageId(),
			'content' => $this->_comment->getContent()
		];
		return Database::safeExecute($query, $values);
	}

	public static function getCommentsByImageId($imageId) {
		$query = "SELECT * FROM comments WHERE imageid=:imageid ORDER BY id ASC";
		$values = ["imageid" => $imageId];
		return Database::selectAllObject($query, $values, 'Comment');
	}
}

?>