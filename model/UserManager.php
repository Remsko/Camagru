<?php
require_once('Manager.php');

class UserManager extends Manager {
    public function __construct() {
        try {
            $this->_db = $this->dbConnect();
        }
        catch (Exception $e) {
            throw $e;
        }
    }

    public function add($user) {
        $addQuery = 'INSERT INTO users(username, mail, password) VALUES(:username, :mail, :password)';
        $query = $this->db->prepare($addQuery);

		if (!$query->bindValue(':username', $user->getUsername())) {
            throw new Exception('Username Input Error');
        }
		if (!$query->bindValue(':mail', $user->getMail())) {
            throw new Exception('Email Input Error');
        }
		if (!$query->bindValue(':password', $user->getPassword())) {
            throw new Exception('Password Input Error');
        }
            
		$query->execute();
    }

    public function delete($user) {
        $deleteQuery = 'DELETE FROM users WHERE id = :id';
        $query = $this->_db->prepare($deleteQuery);

		if (!$query->bindvalue(':id', $user->getId())) {
            throw new Exception('Id Input Error');
        }

		$query->execute();
    }

    public function update($user) {
        $updateQuery = 'UPDATE users SET username = :username, mail = :mail, password = :password WHERE id = :id';
        $query = $this->_db->prepare($updateQuery);

		if (!$query->bindValue(':username', $user->getUsername())) {
            throw new Exception('Username Input Error');
        }
		if (!$query->bindValue(':mail', $user->getMail())) {
            throw new Exception('Email Input Error');
        }
		if (!$query->bindValue(':password', $user->getPassword())) {
            throw new Exception('Password Input Error');
        }
            
        $query->execute();
    }

    public function get($user) {
        $getQuery = 'SELECT pseudo, username, mail FROM users WHERE id = :id';
        $query = $this->_db->prepare($getQuery);

		if (!$query->bindValue(':id', $user->getId())) {
            throw new Exception('ID Input Error.');
        }
            
		$query->execute();
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        
		return new Users($donnees);
    }
}