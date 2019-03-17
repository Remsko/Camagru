<?php

class Commentary {
	private $_id;
	private $_userId;
	private $_imageId;
	private $_content;

	public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}
	
	public function hydrate(array $donnees) {
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($value);
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

	public function setId($id) {
		if (is_int($id)) {
			$this->_id = $id;
		}
	}

	public function setUserId($id) {
		if (is_int($id)) {
			$this->_id = $id;
		}
	}

	public function setImageId($id) {
		if (is_int($id)) {
			$this->_id = $id;
		}
	}

	public function setContent($content) {
		if (is_string($content)) {
		$this->_content = $content;
		}
	}
}

?>