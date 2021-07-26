<?php

require_once 'autoload.php';

require_once 'helpers.php';

/**
 * Setting up the environment.
 */
create_env();

/**
 * Instance the router class
 */
$router = new Core\Router;

require_once 'app/configs/routes.php';

/**
 * Setting up the database.
 */
Core\Database::init();

require_once 'Controller.php';

/**
 * Rendering to browser
 */
$router->render();
