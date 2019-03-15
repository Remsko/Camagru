<?php

class User {
	private $_id;
	private $_username;
	private $_mail;
	private $_password;

	public function __construct(array $data) {
		$this->hydrate($data);
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

	public function getUsername() {
		return $this->_username;
	}

	public function getMail() {
		return $this->_mail;
	}

	public function getPassword() {
		return $this->_password;
	}

	public function setId($id)
	{
		if (is_int($id)) {
			$this->_id = $id;
		}
	}

	public function setUsername($username)
	{
		if (is_string($username)) {
			$this->_username = $username;
		}
	}

	public function setMail($mail)
	{
		if (is_string($mail)) {
			$this->_mail = $mail;
		}
	}

	public function setPassword($password)
	{
		if (is_string($password)) {
			$this->_password = $password;
		}
	}

	public function getByUsername() {
		$query = 'SELECT * FROM users WHERE username=?';
		$values = [$this->getUsername()];
		return Database::selectOneObject($query, $values, 'User');
	}

	public function getByEmail() {
		$query = 'SELECT * FROM users WHERE mail=?';
		$values = [$this->getMail()];
		return Database::selectOneObject($query, $values, 'User');
	}
}

?>
