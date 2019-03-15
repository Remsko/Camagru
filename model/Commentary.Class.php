<?php

class Commentary {
	private $_id;
	private $_username;
	private $_contents;
	private $_date;
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
	public function getUsername() {
		return $this->_username;
	}
	
	public function getContents() {
		return $this->_contents;
	}
	public function getDate() {
		return $this->_date;
	}
	public function setId($id) {
		if (is_int($id)) {
			$this->_id = $id;
		}
	}
	public function setUsername($username) {
		if (is_string($username)) {
			$this->_username = $username;
		}
	}
	public function setContents($contents) {
		if (is_string($contents)) {
		$this->_contents = $contents;
		}
	}
	public function setDate($date) {
		$this->_date = $date;
	}
}
?>