<?php

class Commentary {
	private $_id;
	private $_username;
	private $_imageId;
	private $_content;

	public function __construct(array $datas) {
		$this->hydrate($datas);
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

	public function getUsername() {
		return $this->_username;
	}
	
	public function getImageId() {
		return $this->_imageId;
	}

	public function getContent() {
		return $this->_content;
	}

	public function setId($id) {
		if (is_numeric($id)) {
			$this->_id = $id;
		}
	}

	public function setUsername($username) {
		if (is_numeric($username)) {
			$this->_username = $username;
		}
	}

	public function setImageId($imageId) {
		if (is_numeric($imageId)) {
			$this->_imageId = $imageId;
		}
	}

	public function setContents($content) {
		if (is_string($content)) {
			$this->_content = $content;
		}
	}
}

?>