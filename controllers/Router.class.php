<?php

class Router {
    private $_controller;
    private $_view;

    public function routeRequest() {
        try {
            spl_autoload_register(function($class) {
                require_once('models/'.$class.'.class.php');
            });

            $url = [];
            if (isset($_GET['url'])) {
                $urlVariables = filter_var($_GET['url']);
                $url = explode('/', $urlVariables, FILTER_SANITIZE_URL);
            
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = 'Controller'.$controller;
                $controllerFile = 'controllers/'.$controllerClass.'.class.php';
            
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_controller = new $controllerClass($url);
                }
                else {
                    throw new Exception('Page not found');
                }
            }
            else {
                require_once('controllers/ControllerHome.class.php');
                $this->_controller = new ControllerHome($url);
            }
        }
        catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('views/error/error.php');
        }
    }
}

?>