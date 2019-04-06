<?php declare(strict_types = 1);

use BDC\Framework\Routing\HttpMethod;
use BDC\Framework\Routing\Route;

$routes = array();

$routes[] = new Route(HttpMethod::GET, '/', 'BDC\FrontPage\Presentation\FrontPageController#show');
$routes[] = new Route(HttpMethod::GET, '/newsletter', 'BDC\Newsletter\Presentation\NewsletterController#show');
$routes[] = new Route(HttpMethod::GET, '/newsletter/success', 'BDC\Newsletter\Presentation\NewsletterController#success');
$routes[] = new Route(HttpMethod::POST, '/newsletter/signup', 'BDC\Newsletter\Presentation\NewsletterController#signup');

return $routes;