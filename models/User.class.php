<?php

class User {
	private $_id;
	private $_username;
	private $_mail;
	private $_password;
	private $_notifications;
	private $_valid;

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

	public function getValid() {
		return $this->_valid;
	}

	public function getNotifications() {
		return $this->_notifications;
	}

	public function setId($id)
	{
		if (is_numeric($id)) {
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

	public function setValid($valid) {
		$this->_valid = $valid;
	}

	public function setNotifications($notifications) {
		$this->_notifications = $notifications;
	}
}

?>
