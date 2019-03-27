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
        if (isset($_POST['signInForm'])) {
            $this->_userManager = new UserManager();
            $error = $this->_userManager->connectUser();
        }
        if (isset($_SESSION['userId'])) {
            //Router::go('Gallery'); redir to gallery
        }
        $this->_view = new View('SignIn');
        $this->_view->generate(['error' => $error]);
    }

    public function signup() {
        $error = null;
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
        //Router::go('Gallery'); redir to gallery
    }

    public function settings() {
        if (!isset($_SESSION['userId'])) {
            throw new Exception('You need to be connected to access the settings !');
        }
        $user = UserManager::getByUserId($_SESSION['userId']);
        $error = null;
        if (isset($_POST['editProfil'])) {

        }

        $this->_view = new View('Settings');
        $this->_view->generate([
            'user' => $user,
            'error' => $error
        ]);
    }
}