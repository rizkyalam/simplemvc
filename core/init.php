<?php

require_once 'autoload.php';

require_once 'helpers.php';

create_env();

/**
 * Instance the router class
 */
$router = new Core\Router;

require_once 'app/configs/routes.php';

Core\Database::init();

require_once 'Controller.php';

$router->render();
