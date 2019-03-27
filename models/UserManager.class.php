<?php

class UserManager {
	private $_user;

    public function checkMail($mail) {
        if (strlen($mail) > 30) {
			return 'Email is too long !';
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			return 'Email is not valid';
        }
        if ($this->getByMail($mail)) {
            return 'Email is already taken !';
        }
        return null;
    }

    public function checkPassword($password) {
        if (strlen($password) > 20) {
			return 'Password is too long !';
		}
		if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$#', $password)) {
			return 'Password must contain minimum eight characters, one uppercase letter, one lowercase letter and one number !';
        }
        return null;
    }

    public function checkUsername($username) {
        if (strlen($username) > 15) {
			return 'Username is too long !';
        }
        if ($this->getByUsername($username)) {
            return 'Username is already taken !';
        }
        return null;
    }

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
        if ($error = $this->checkUsername($username)) {
            return $error;
        }
        if ($error = $this->checkPassword($password)) {
            return $error;
        }
        if ($error = $this->checkMail($mail)) {
            return $error;
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

    public function checkEditProfilForm() {
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        if (empty($username) || empty($mail)) {
			return 'All fields need to be completed !';
        }
        $user = $this->getByUsername($username);
        if (isset($user) && $this->_user->getId() !== $user->getId()) {
            return 'Username is already taken !';
        }
        $user = $this->getByMail($mail);
        if (isset($user) && $this->_user->getId() !== $user->getId()) {
            return 'Email adress is already taken !';
        }
        return null;
    }

    public function checkPasswordForm() {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];
        if (empty($oldPassword) || empty($newPassword) || empty($confirmNewPassword)) {
            return 'All fields need to be completed !';
        }
        if ($newPassword !== $confirmNewPassword) {
            return 'New passwords does not match !';
        }
        if (!$this->authUser($oldPassword)) {
            return 'Your old password is wrong !';
        }
        if ($error = $this->checkPassword($newPassword)) {
            return $error;
        }
        return null;
    }

    public function changePassword($user) {
        $this->_user = $user;
        if ($error = $this->checkPasswordForm()) {
            return $error;
        }
        $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
        $user->setPassword($newPassword);
        if (!$this->updateUser($user)) {
            return 'Failed to update your password !';
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
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $this->_user = new User([
            'username' => $username,
            'mail' => $mail,
            'password' => $password
        ]);
        if (!$this->insertUser($this->_user)) {
            return 'Failed to add your account to the database !';
        }
        return null;
    }

    public function editUser($user) {
        $this->_user = $user;
        if ($error = $this->checkEditProfilForm()) {
            return $error;
        }
        $username = htmlspecialchars($_POST['username']);
        $mail = htmlspecialchars($_POST['mail']);
        $notifications = isset($_POST['notifications']) ? 1 : 0;
        
        $user->setUsername($username);
        $user->setMail($mail);
        $user->setNotifications($notifications);
        if (!$this->updateUser($user)) {
            return 'Failed to update your account !';
        }
        return null;
    }

    public function setSessionUser() {
        return $_SESSION['userId'] = $this->_user->getId();
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
        $this->setSessionUser();
        return null;
    }

	
    public function authUser($password) {
        return password_verify($password, $this->_user->getPassword());
    }
    
    public function getByUserId($userId) {
		$query = 'SELECT * FROM users WHERE id=:userId';
		$values = ['userId' => $userId];
		return Database::selectOneObject($query, $values, 'User');
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

    private function insertUser($user) {
		$query = 'INSERT INTO users(username, mail, password) VALUES(:username, :mail, :password)';
		$values = [
			'username' => $user->getUsername(),
			'mail' => $user->getMail(),
			'password' => $user->getPassword()
		];
		return Database::safeExecute($query, $values);
    }

    public function updateUser($user) {
        $query = 'UPDATE users SET username=:username, mail=:mail, password=:password, notifications=:notifications, valid=:valid WHERE id=:id';
        $values = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'mail' => $user->getMail(),
            'password' => $user->getPassword(),
            'notifications' => $user->getNotifications(),
            'valid' => $user->getValid()
        ];
        return Database::safeExecute($query, $values);
    }
}

?>
