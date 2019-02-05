<?php declare(strict_types = 1);

use BDC\Framework\Routing\Route;

$routes = array();

$routes[] = new Route('GET', '/', 'BDC\FrontPage\Presentation\FrontPageController#show');

return $routes;