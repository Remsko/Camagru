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
		$q = $this->_db->prepare('INSERT INTO users(userName, Email) VALUES(:userName, :Email)');

		$q->bindValue(':userName', $perso->nom());
		$q->bindValue(':Email', $perso->email());

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
	public function email(){ return $this->_username; }

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
}