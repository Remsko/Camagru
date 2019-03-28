<?php

require_once('views/View.class.php');

class Router {
    private $_controller;
    private $_method;
    private $_url;
    private $_view;

    private function url() {
        $url = ['Gallery'];

        if (isset($_GET['url'])) {
            $urlVariables = filter_var($_GET['url']);
            $url = explode('/', $urlVariables, FILTER_SANITIZE_URL);
        }
        return $url;
    }

    private function controller() {
        $controller = ucfirst(strtolower($this->_url[0]));
        $controllerClass = 'Controller'.$controller;
        $controllerFile = 'controllers/'.$controllerClass.'.class.php';

        if (file_exists($controllerFile)) {
            require_once($controllerFile);
        }
        else {
            throw new Exception('Page not found');
        }
        return new $controllerClass($this->_url);
    }

    public function routeRequest() {
        try {
            spl_autoload_register(function($class) {
                require_once('models/'.$class.'.class.php');
            });
            print_r($_GET);
            $this->_url = $this->url();
            $this->_controller = $this->controller();

            if (isset($this->_url[1])) {
                $this->_method = $this->_url[1];
                if (method_exists($this->_controller, $this->_method)) {
                    call_user_func_array([$this->_controller, $this->_method], $this->_url);
                }
                else {
                    throw new Exception('Page not found');
                }
            }
        }
        catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}

?>