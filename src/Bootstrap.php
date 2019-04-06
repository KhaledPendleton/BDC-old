<?php declare(strict_types = 1);

define('ROOT_DIR', dirname(__DIR__));

require_once(ROOT_DIR . '/vendor/autoload.php');

// External packages
use Tracy\Debugger;
use DI\ContainerBuilder;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Internal packages
use BDC\Framework\Routing\Route;

Debugger::enable();

$request = Request::createFromGlobals();

// Request data essential for routing
$requestMethod = $request->getMethod();
$requestPath = $request->getPathInfo();

// Add route declarations to route collector
$dispatcher = simpleDispatcher(function(RouteCollector $collector) {
    $routes = require_once(ROOT_DIR . '/src/Routes.php');

    foreach ($routes as $route) {
        if (!$route instanceof Route) {
            throw new Exception('Route list must contain objects of type Route');
        }

        $collector->addRoute(...$route->toArray());
    }
});

// Strip query string (?foo=bar) and decode URI
// Query string data will be stored in Request instance
// -- Accessible by $request->query->get('foo');
if (false !== $position = strpos($requestPath, '?')) {
    $requestPath = substr($requestPath, 0, $position);
}

$requestPath = rawurldecode($requestPath);
$routeInfo = $dispatcher->dispatch($requestMethod, $requestPath);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        // Handle 404
        $controller = $container->get('BDC\Error\Presentation\NotFoundController');
        $response = $controller->show();
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        // Handle 405
        $controller = $container->get('BDC\Error\Presentation\MethodNotAllowedController');
        $response = $controller->show();
        break;
    case Dispatcher::FOUND:
        [$controllerName, $method] = explode('#', $routeInfo[1]);
        $vars = $routeInfo[2];

        $definitions = require_once(ROOT_DIR . '/src/Dependencies.php');
        $builder = new ContainerBuilder();
        $builder->addDefinitions($definitions);
        $container = $builder->build();

        $controller = $container->get($controllerName);
        $response = $controller->$method($request, $vars);
        break;
    default:
        // THIS SHOULD NEVER EVER IN A MILLION YEARS BE CALLED
        throw new Exception('Router dispatcher returned unknown value');
        break;
}

if (!$response instanceof Response) {
    throw new \Exception('Controller methods must return a Response object');
}

$response->prepare($request);
$response->send();