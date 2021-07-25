<?php

require_once 'autoload.php';

require_once 'helpers.php';

/**
 * Instance the router class
 */
$router = new Core\Router;

require_once 'app/configs/routes.php';

require_once 'Controller.php';

$router->render();

// $env = file_get_contents('.env');

// echo $env;