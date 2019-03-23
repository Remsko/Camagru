<?php

class Comment {
	private $_id;
	private $_userId;
	private $_imageId;
	private $_username;
	private $_content;

	public function __construct(array $datas) {
		$this->hydrate($datas);

		$userId = $this->getUserId();
		if (isset($userId)) {
			if ($user = UserManager::getByUserId($userId)) {
				$this->setUsername($user->getUsername());
			}
		}
	}
	
	public function hydrate(array $datas) {
		foreach ($datas as $key => $value) {
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
	
	public function getImageId() {
		return $this->_imageId;
	}

	public function getContent() {
		return $this->_content;
	}

	public function getUsername() {
		return $this->_username;
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

	public function setImageId($imageId) {
		if (is_numeric($imageId)) {
			$this->_imageId = $imageId;
		}
	}

	public function setContent($content) {
		if (is_string($content)) {
			$this->_content = $content;
		}
	}

	public function setUsername($username) {
		if (is_string($username)) {
			$this->_username = $username;
		}
	}
}

?>