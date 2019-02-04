<?php

$routes = array();

$routes[] = ['GET', '/', 'BDC\FrontPage\Presentation\FrontPageController#show'];

return $routes;