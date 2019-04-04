<?php

require_once('views/View.class.php');

class ControllerUser {
    private $_userManager;
    private $_view;

    public function __construct($url) {
        if (!isset($url) || count($url) !== 2) {
            throw new Exception('Page not found');
        }
    }

    public function signin() {
        $error = null;
        if (isset($_SESSION['userId'])) {
            throw new Exception('You are already connected !');
        }
        if (isset($_POST['signInForm'])) {
            $this->_userManager = new UserManager();
            $error = $this->_userManager->connectUser();
        }
        if (isset($_SESSION['userId'])) {
            Router::redirectionRequest('');
        }
        $this->_view = new View('viewSignIn');
        $this->_view->generate(['error' => $error]);
    }

    public function signup() {
        $error = null;
        if (isset($_SESSION['userId'])) {
            throw new Exception('You are already connected !');
        }
        if (isset($_POST['signUpForm'])) {
            $this->_userManager = new UserManager();
            $error = $this->_userManager->createUser();

			if (!$error) {
				echo '<span>Your account has been created !</span><br />';
			}
        }
        
        $this->_view = new View('viewSignUp');
        $this->_view->generate(['error' => $error]);
    }

    public function logout() {
        if (isset($_SESSION['userId'])) {
            unset($_SESSION['userId']);
        }
        Router::redirectionRequest('');
    }

    public function settings() {
        $error = null;
        if (!isset($_SESSION['userId'])) {
            throw new Exception('You must be connected to access the settings !');
        }
        $this->_userManager = new UserManager();
        $user = $this->_userManager->getByUserId($_SESSION['userId']);
        if (isset($_POST['editProfile'])) {
            $error = $this->_userManager->editUser($user);

            if (!$error) {
				echo '<span>Your account has been edited !</span><br />';
			}
        }
        if (isset($_POST['changePassword'])) {
            $error = $this->_userManager->changePassword($user);

            if (!$error) {
				echo '<span>Your password has been changed !</span><br />';
			}
        }
        $this->_view = new View('viewSettings');
        $this->_view->generate([
            'user' => $user,
            'error' => $error
        ]);
    }

    public function verification() {
        if (isset($_SESSION['userId'])) {
            throw new Exception('You are already connected !');
        }
        if (empty($_GET['username']) || empty($_GET['hash'])) {
            throw new Exception('Page not found');
        }
        $username = $_GET['username'];
        $hash = $_GET['hash'];

        $this->_userManager = new UserManager();
        $user = $this->_userManager->getByUsername($username);
        $message = 'An error occured !';
        if (isset($user)) {
            if ($user->getValidation()) {
                $message = 'Your account is already confirmed !';
            }
            else if (!strcmp($user->getHash(), $hash)) {
                $message = 'Your account has been confirmed !';
                $user->setValidation(1);
                $this->_userManager->updateUser($user);
            }
        }
        $this->_view = new View('viewVerification');
        $this->_view->generate(['message' => $message]);
    }

    public function reset() {
        $error = null;
        if (isset($_SESSION['userId'])) {
            throw new Exception('You are already connected !');
        }
        if (isset($_POST['resetForm'])) {
            echo 'reset form triggered';
            $this->_userManager = new UserManager();
            $error = $this->_userManager->resetPassword();
            if (!$error) {
                echo '<span>A reset mail has been send !</span><br />';
            }
        }
        $this->_view = new View('viewReset');
        $this->_view->generate(['error' => $error]);
    }

    public function newpassword() {
        $error = null;
        if (isset($_SESSION['userId'])) {
            throw new Exception('You are already connected !');
        }
        if (empty($_GET['username']) || empty($_GET['hash'])) {
            throw new Exception('Page not found');
        }
        $username = $_GET['username'];
        $resetHash = $_GET['hash'];

        $this->_userManager = new UserManager();
        $user = $this->_userManager->getByUsername($username);
        if (empty($user)) {
            throw new Exception('User not found !');
        }
        $userResetHash = $user->getResetHash();
        if (empty($userResetHash)) {
            throw new Exception('There is no reset hash !');
        }
        if ($userResetHash != $resetHash) {
            throw new Exception('The reset hash is wrong !');
        }

        if (isset($_POST['newPasswordForm'])) {
            $error = $this->_userManager->newPassword($user);
            if (!$error) {
				echo '<span>Your password has been updated !</span><br />';
			}
        }
        $this->_view = new View('viewNewPassword');
        $this->_view->generate(['error' => $error]);
    }
}
