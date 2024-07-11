<?php

require_once "router/Router.php";

$router = new Router();

// Add routes without the prefix
$router->addRoute('POST', '/create', require __DIR__ . "/routes/create.php");
$router->addRoute('GET', '/update', require __DIR__ . "/routes/update.php");
$router->addRoute('GET', '/list', require __DIR__ . "/routes/list.php");

// Define the prefix
$prefix = '/mobile_rest_api';

// Match route with prefix
try {
    $router->matchRoute($prefix);
} catch (Exception $e) {
    echo $e->getMessage();
}
