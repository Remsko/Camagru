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
        $this->_view = new View('SignIn');
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
        
        $this->_view = new View('SignUp');
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
        $this->_view = new View('Settings');
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
        $this->_view = new View('Verification');
        $this->_view->generate(['message' => $message]);
    }
}
