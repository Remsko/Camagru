<?php
require_once('Manager.php');

class UserManager extends Manager {
    public function __construct() {
        try {
            $this->db = $this->dbConnect();
        }
        catch (Exception $e) {
            throw $e;
        }
    }

    public function add($user) {
        $addQuery = 'INSERT INTO users(username, pseudo, email, password) VALUES(:username, :pseudo, :email, :password)';
        $query = $this->db->prepare($addQuery);

		if (!$query->bindValue(':username', $user->username())) {
            throw new Exception('Username Input Error');
        }
		if (!$query->bindValue(':pseudo', $user->pseudo())) {
            throw new Exception('Pseudo Input Error');
        }
		if (!$query->bindValue(':email', $user->email())) {
            throw new Exception('Email Input Error');
        }
		if (!$query->bindValue(':password', $user->password())) {
            throw new Exception('Password Input Error');
        }
            
		$query->execute();
    }

    public function delete($user) {
        $deleteQuery = 'DELETE FROM users WHERE id = :id';
        $query = $this->_db->prepare($deleteQuery);

		if (!$query->bindvalue(':id', $user->id())) {
            throw new Exception('Id Input Error');
        }

		$query->execute();
    }

    public function update($user) {
        $updateQuery = 'UPDATE users SET username = :username, pseudo = :pseudo, email = :email, password = :password WHERE id = :id';
        $query = $this->_db->prepare($updateQuery);

		if (!$query->bindValue(':username', $user->username())) {
            throw new Exception('Username Input Error');
        }
		if (!$query->bindValue(':pseudo', $user->pseudo())) {
            throw new Exception('Pseudo Input Error');
        }
		if (!$query->bindValue(':email', $user->email())) {
            throw new Exception('Email Input Error');
        }
		if (!$query->bindValue(':password', $user->password())) {
            throw new Exception('Password Input Error');
        }
            
        $query->execute();
    }

    public function get($user) {
        $getQuery = 'SELECT pseudo, username, email FROM users WHERE id = :id';
        $query = $this->_db->prepare($getQuery);

		if (!$query->bindValue(':id', is_int($user->id()))) {
            throw new Exception('ID Input Error.');
        }
            
		$query->execute();
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        
		return new Users($donnees);
    }
}