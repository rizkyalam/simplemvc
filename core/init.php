<?php

use Core\Router;
use Core\HttpError;

require_once 'Router.php';
require_once 'HttpError.php';

/**
 * Instance the router class
 */
$router = new Router;

require_once 'app/configs/routes.php';

require_once 'autoload.php';

$router->renderFile();

// $env = file_get_contents('.env');

// echo $env;