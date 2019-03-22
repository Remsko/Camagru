<?php

class Image {
		private $_id;
		private $_userId;
		private $_path;
		private $_comments;
		private $_likes;
		private $_isLiked;

		public function __construct(array $data) {
			$this->hydrate($data);

			$comments = CommentManager::getCommentsByImageId($this->getId());
			$likes = ImageManager::getLikesByImageId($this->getId());
			$isLiked = ImageManager::isLiked();
			$this->setComments($comments);
			$this->setLikes($likes);
			$this->setIsLiked($isLiked);
		}
		
		public function hydrate(array $data) {
			foreach ($data as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}

		public function getId() {
			return $this->_id;
		}

		public function getUserId() {
			return $this->_userId;
		}

		public function getPath() {
			return $this->_path;
		}

		public function getComments() {
			return $this->_comments;
		}

		public function getLikes() {
			return $this->_likes;
		}

		public function getIsLiked() {
			return $this->_isLiked;
		}

		public function setId($id) {
			if (is_numeric($id)) {
				$this->_id = $id;
			}
		}

		public function setUserId($userId) {
			if (is_numeric($userId)) {
				$this->_userId = $userId;
			}
		}

		public function setPath($path) {
			if (is_string($path)) {
				$this->_path = $path;
			}
		}

		public function setComments($comments) {
			$this->_comments = $comments;
		}

		public function setLikes($likes) {
			if (is_numeric($likes)) {
				$this->_likes = $likes;
			}
		}

		public function setIsLiked($isLiked) {
			if (is_bool($isLiked)) {
				$this->_isLiked = $isLiked;
			}
		}
}

?>