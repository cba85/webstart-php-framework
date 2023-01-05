<?php

$router->map('GET', '/', App\Controllers\IndexController::class);
$router->map('GET', '/contact', 'App\Controllers\ContactController::displayForm');
// $router->map('POST', '/contact', 'App\Controllers\ContactController::send');