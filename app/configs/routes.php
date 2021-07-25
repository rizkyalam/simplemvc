<?php

$router->get('/', [HomeController::class, 'index']);
$router->get('/euy', [HomeController::class, 'test']);

$router->get('/user', [HomeController::class, 'user']);
$router->get('/test/{id}/{test}', [HomeController::class, 'getId']);
