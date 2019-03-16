<?php

session_start();

require('controllers/Router.class.php');

$router = new Router();
$router->routeRequest();

?>