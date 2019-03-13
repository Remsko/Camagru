<?php

class User {
	private $_id;
	private $_username;
    private $_mail;
    private $_password;

	public function __construct(array $donnees) {
		$this->hydrate($donnees);
    }
    
	public function hydrate(array $donnees) {
		foreach ($donnees as $key => $value) {
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
}

?>