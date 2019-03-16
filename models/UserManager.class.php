<?php

class UserManager {
	private $_user;

    public function checkSignUpForm() {
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $mailConfirm = $_POST['mailConfirm'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        if (empty($username) || empty($mail) || empty($mailConfirm) || empty($password) || empty($passwordConfirm)) {
			return 'All fields need to be completed !';
        }
        if ($mail !== $mailConfirm) {
            return 'Email adresses does not match !';
        }
        if ($password !== $passwordConfirm) {
            return 'Passwords does not match !';
        }
		if (strlen($username) > 15) {
			return 'Username is too long !';
        }
		if (strlen($mail) > 30) {
			return 'Email is too long !';
		}
		if (strlen($password) > 20) {
			return 'Password is too long !';
		}
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			return 'Email is not valid';
		}
		if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$#', $password)) {
			return 'Password must contain minimum eight characters, one uppercase letter, one lowercase letter and one number !';
        }
        return null;
    }

    public function checkSignInForm() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)) {
            return 'All fields need to be completed';
        }

        return null;
    }

	public function createUser()
	{
        if ($error = $this->checkSignUpForm()) {
            return $error;
        }

		$username = htmlspecialchars($_POST['username']);
		$mail = htmlspecialchars($_POST['mail']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($this->getByUsername($username)) {
            return 'Username is already taken !';
        }
        if ($this->getByMail($mail)) {
            return 'Email is already taken !';
        }

        $this->_user = new User(array(
            'username' => $username,
            'mail' => $mail,
            'password' => $password
        ));

        if (!$this->push()) {
            return 'Failed to add your account to the database !';
        }

        return null;
    }

    public function connectUser() {
        if ($error = $this->checkSignInForm()) {
            return $error;
        }
        if (!$this->_user = $this->getByUsername($_POST['username'])) {
            return 'Your account doesn\'t exist !';
        }
        if (!$this->authUser($_POST['password'])) {
            return 'Your password is wrong !';
        }

        return null;
    }

	private function push() {
		$query = 'INSERT INTO users(username, mail, password) VALUES(:username, :mail, :password)';
		$values = [
			'username' => $this->_user->getUsername(),
			'mail' => $this->_user->getMail(),
			'password' => $this->_user->getPassword()
		];
		return Database::safeExecute($query, $values);
	}

	public function getByUsername($username) {
		$query = 'SELECT * FROM users WHERE username=:username';
		$values = ['username' => $username];
		return Database::selectOneObject($query, $values, 'User');
	}

	public function getByMail($mail) {
		$query = 'SELECT * FROM users WHERE mail=:mail';
		$values = ['mail' => $mail];
		return Database::selectOneObject($query, $values, 'User');
	}

    public function authUser($password) {
        return password_verify($password, $this->_user->getPassword());
    }
}

?>
