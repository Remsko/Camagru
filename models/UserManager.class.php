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

	public function createUser()
	{
        $error = checkSignUpForm();
        if (isset($error)) {
            return $error;
        }

		$username = htmlspecialchars($_POST['username']);
		$mail = htmlspecialchars($_POST['mail']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $this->_user = new User(array(
            'username' => $username,
            'mail' => $mail,
            'password' => $password
        ));

        if ($this->_user->getByUsername()) {
            return 'Username is already taken !';
        }
        if ($this->_user->getByMail()) {
            return 'Email is already taken !';
        }
        
        return null;
    }
    
    public function authUser($password) {
        return password_verify($this->_user->getPassword(), $password);
    }
}

?>
