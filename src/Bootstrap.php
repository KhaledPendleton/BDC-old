<?php declare(strict_types = 1);

// Set constant path for root directory
define('ROOT_DIR', dirname(__DIR__));

// Require autoloader
require_once(ROOT_DIR . '/vendor/autoload.php');

use Tracy\Debugger;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

Debugger::enable();

// Convert PHP globals to single request object
$request = Request::createFromGlobals();

// Add route declarations to route collector
$dispatcher = simpleDispatcher(function(RouteCollector $collector) {
    $routes = require_once(ROOT_DIR . '/src/Routes.php');

    foreach ($routes as $route) {
        $collector->addRoute(...$route->toArray());
    }
});

$routeInfo = $dispatcher->dispatch(
    $request->getMethod(),
    $request->getPathInfo()
);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        // Handle 404
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        // Handle 405
        break;
    case Dispatcher::FOUND:
        [$controllerName, $method] = explode('#', $routeInfo[1]);
        $vars = $routeInfo[2];

        $response = new Response("Page found", Response::HTTP_OK);
        break;
}

if (!$response instanceof Response) {
    throw new \Exception('Controller methods must return a Response object');
}

$response->prepare($request);
$response->send();