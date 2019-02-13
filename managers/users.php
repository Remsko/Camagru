<?php

	include ("database.php");

class UsersManager {
	private $_db;

	private function __construct($db)
	{
		$this->setDb($db);
	}

	public	function add(Users $user)
	{
		$q = $this->_db->prepare('INSERT INTO users(Pseudo, Email, Username, Password) VALUES(:Pseudo, :Email, :Username, :Password)');

		$q->bindValue(':Pseudo', $perso->nom());
		$q->bindValue(':Email', $perso->email());
		$q->bindValue(':Username', $perso->username());
		$q->bindValue(':Password', $perso->password());

		$q->execute();
	}
}

class Users {
	private $_id,
			$_pseudo,
			$_mail,
			$_username,
			$_password;
	public function id() { return $this->_id; }
	public function pseudo() { return $this->_pseudo; }
	public function email(){ return $this->_email; }
	public function username() {return $this->_username; }
	public function password() {return $this->_password; }

	public function setEmail($mail)
	{
		if (is_string($mail))
		{
			$this->_mail = $mail;
		}
	}
	
	public function setPseudo($pseudo)
	{
		if (is_string($pseudo))
		{
			$this->_pseudo = $pseudo;
		}
	}

	public function setUsername($username)
	{
		if (is_string($username))
		{
			$this->_username = $username;
		}
	}

	public function setPassword($password)
	{
		if (is_string($password))
		{
			$this->_password = $password;
		}
	}
}
$db = new PDO('mysql:host=127.0.0.1;dbname=USERS', 'root', 'bdroot');