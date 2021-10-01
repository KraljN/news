<?php

use \Bramus\Router\Router;

// Require composer autoloader
require __DIR__ . '/Vendor/autoload.php';

//My autoloader
require 'autoload.php';

// Create Router instance
$router = new Router();

// Define routes
// ...
require __DIR__ . '/App/routes.php';

// Run it!
$router->run();
