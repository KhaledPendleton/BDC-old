<?php declare(strict_types = 1);

// Get directory path for parent of current directory
define('ROOT_DIR', dirname(__DIR__));

// Reuire autoloader
require_once(ROOT_DIR . '/vendor/autoload.php');

use Tracy\Debugger;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

Debugger::enable();

$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    // Gets route declarations
    $routes = require_once(ROOT_DIR . '/src/Routes.php');

    // Iterate over route declarations and add them to route collector
    foreach ($routes as $route) {
        $r->addRoute(
            $route->getMethod(),
            $route->getPath(),
            $route->getCallback()
        );
    }
});
