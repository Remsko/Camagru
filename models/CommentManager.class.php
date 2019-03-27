<?php

class CommentManager {
	private $_comment;

	public function checkCommentForm() {
		$userId = $_SESSION['userId'];
		$imageId = $_POST['imageId'];
		$content = $_POST['comment'];

		if (empty($userId) || empty($imageId)) {
			return 'An error occurred.';
		}
		if (empty($content)) {
			return 'Comment is empty !';
		}
		if (strlen($content) > 300) {
			return 'Comment is too long !';
		}
		return null;
	}

	public function notif($imageId, $userId) {
		$userManager = new UserManager();
		$send = $userManager->getByUserId($userId);
		$receive = $userManager->getByImageId($imageId);

		if (empty($send) || empty($receive)) {
			return ;
		}
		if ($receive->getNotifications()) {
			$to = $receive->getMail();
    		$subject = 'Camagru Notification';
    		$message = 'Hello ! '.$send->getUsername().' commented your picture !';
		
			mail($to, $subject, $message);
		}
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

		if (!$this->pushComment()) {
            return 'Failed to add your comment to the picture !';
		}
		$this->notif($imageId, $userId);
		return null;
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
		$query = "SELECT * FROM comments WHERE imageid=:imageId ORDER BY id ASC";
		$values = ["imageId" => $imageId];
		return Database::selectAllObject($query, $values, 'Comment');
	}
}

?>